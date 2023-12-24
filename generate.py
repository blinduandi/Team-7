import pandas as pd 
import numpy as np 
import random
import copy

def read_data():
    group_df = pd.read_csv('Team-7/storage/app/csv/groups.csv')
    room_df = pd.read_csv('Team-7/storage/app/csv/rooms.csv')
    subject_df = pd.read_csv('Team-7/storage/app/csv/subjects.csv')
    profesors_df = pd.read_csv('Team-7/storage/app/csv/teachers.csv')
    
    subject_df = subject_df[(subject_df['semester'] != 2) & (subject_df['semester'] != 4)]
    group_lectures = dict(zip(group_df['id'], [list(map(str.strip, subjects.split(','))) for subjects in group_df['subject_id'].astype(str)]))
    subjects_dict = {}
    for _, row in subject_df.iterrows():
        key = row['id']
        value = [
            1 if row['theory'] >= 30 else 0,
            1 if row['practice'] >= 30 else 0,
            1 if row['lab'] >= 30 else 0
        ]
        subjects_dict[str(key)] = value
    prof_dict = {}
    for _, row in profesors_df.iterrows():
        key = (row['id'], row['subject_id'], row['type_class_id'])
        value = row[4:].tolist()
        prof_dict[key] = value
    lab_rooms = []
    norm_rooms = []
    for _, row in room_df.iterrows():
        if row['is_lab_cab'] == 1:
            lab_rooms.append(row['id'])
        else:
            norm_rooms.append(row['id'])
    return group_lectures, subjects_dict, prof_dict, norm_rooms, lab_rooms


def generate_schedule():
   
    schedules = []
    for _ in range(1):
        group_lectures, subjects_dict, prof_dict, norm_rooms, lab_rooms = read_data()
        schedule = {}
        occupied_rooms = {}
        occupied_prof = {}
        for i in range(5):  # 0 to 4
            for j in range(0, 7):  # 1 to 7
                occupied_rooms[(i, j)] = []
                occupied_prof[(i,j)] = []
        for group, lectures in group_lectures.items():
            new_subjects_dict = copy.deepcopy(subjects_dict)
            new_lectures = copy.deepcopy(lectures)
            days = []
            for l in new_lectures:
                try:
                    subjects_dict[l]
                except:
                    lectures.remove(l)
            for day in range(5):
                num_lectures = random.choice([2,3,4])
                day_lectures = [[],[],[],[],[],[],[]]
                available_lectures = [0,1,2,3,4,5,6]
                index = 1
                if num_lectures < len(lectures) and day == 4:
                    num_lectures = len(lectures)
                while index <= num_lectures and len(lectures) > 0:
                    l = random.choice(lectures)
                    if all(element == 0 for element in new_subjects_dict[l]):
                        lectures.remove(l)
                        continue
                    else:
                        theory = 0
                        seminars = 0
                        lab = 0
                        for i in range(len(new_subjects_dict[l])):
                            if new_subjects_dict[l][i] == 1:
                                if i == 0:
                                    theory = 1
                                elif i == 1:
                                    seminars = 1
                                elif i == 2:
                                    lab = 1
                                new_subjects_dict[l][i] = 0
                                break
                        ins_index = random.choice(available_lectures)
                        available_lectures.remove(ins_index)
                        if theory:
                            cabinet = random.choice(norm_rooms)
                            while cabinet in occupied_rooms[(day,ins_index)]:
                                cabinet = random.choice(norm_rooms)
                            occupied_rooms[(day,ins_index)].append(cabinet)
                            day_lectures[ins_index] = [l, 'theory', cabinet, int(l)]
                        if seminars:
                            cabinet = random.choice(norm_rooms)
                            while cabinet in occupied_rooms[(day, ins_index)]:
                                cabinet = random.choice(norm_rooms)
                            occupied_rooms[(day, ins_index)].append(cabinet)
                            day_lectures[ins_index] = [l, 'seminars', cabinet, int(l)]
                        if lab:
                            cabinet = random.choice(lab_rooms)
                            while cabinet in occupied_rooms[(day, ins_index)]:
                                cabinet = random.choice(norm_rooms)
                            occupied_rooms[(day, ins_index)].append(cabinet)
                            day_lectures[ins_index] = [l, 'lab', cabinet, int(l) + 117]
                        index -= -1
            
                #print(f"group: {group} day: {day} lectures: {day_lectures}")
                days.append(day_lectures)
            schedule[group] = days
        schedules.append(schedule)
        return schedule

if __name__ == "__main__":
    generate_schedule()
