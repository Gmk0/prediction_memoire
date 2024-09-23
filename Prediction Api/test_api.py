from locust import HttpUser, TaskSet, task, between

class UserBehavior(TaskSet):
    @task
    def predict_diabetes(self):
        self.client.post("/predict", json={"features": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]})

class WebsiteUser(HttpUser):
    tasks = [UserBehavior]
    wait_time = between(1, 5)
