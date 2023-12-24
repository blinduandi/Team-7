from flask import Flask, request, jsonify
from generate import generate_schedule

app = Flask(__name__)

@app.route('/get-json', methods=['GET'])
def get_json():
    # Your data to be returned as JSON
    data = {
        'message': 'Hello, this is a JSON response!',
        'status': 'success'
    }

    # Convert the data to JSON and return as response
    return jsonify(data)

@app.route('/upload-csv', methods=['GET'])
def upload_csv():
    schedule = generate_schedule()
    print(schedule)
    return jsonify(schedule)
if __name__ == '__main__':
    app.run(debug=True)

