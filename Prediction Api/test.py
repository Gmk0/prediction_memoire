from flask import Flask, jsonify, make_response
from flask_restx import Api, Resource

app = Flask(__name__)
api = Api(app)

@api.route('/example')
class Example(Resource):
    def get(self):
        data = {
            "message": "Hello, World!"
        }
        return make_response(jsonify(data), 200)

if __name__ == '__main__':
    app.run(debug=True)