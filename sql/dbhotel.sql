CREATE TABLE countries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE controls (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  country_id INT NOT NULL,
  forecast_stay INT,
  FOREIGN KEY (country_id) REFERENCES countries (id)
);

CREATE TABLE airlines (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE control_airlines (
  control_id INT NOT NULL,
  airline_id INT NOT NULL,
  PRIMARY KEY (control_id, airline_id),
  FOREIGN KEY (control_id) REFERENCES controls(id),
  FOREIGN KEY (airline_id) REFERENCES airlines(id)
);