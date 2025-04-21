CREATE DATABASE Company;
USE Company;

CREATE TABLE Departement(
    DeptID int AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Location varchar(255));
    
CREATE TABLE Employee(
    EmpID int AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Age int,
    Salary decimal(10,2),
    DeptID int,
    FOREIGN KEY (DeptID) REFERENCES Departement(DeptID)
);

CREATE TABLE Project(
    ProjID int AUTO_INCREMENT PRIMARY KEY,
    Title varchar(255) NOT NULL,
    Budget decimal(12,2),
    DeptID int,
    FOREIGN KEY (DeptID) REFERENCES Departement(DeptID)
);

INSERT INTO Departement(Name, Location) VALUES ('Informatique', 'Paris'), ('Ressources Humaines', 'Lyon'), ('Finance', 'Marseille');

INSERT INTO Employee(Name, Age, Salary, DeptID) VALUES ('Alice', 28, 3500.00, 1), ('Bob', 35, 5000.00, 1), ('Charlie', 30, 4500.00, 2), ('David', 40, 6000.00, 3), ('Emma', 29, 3800.00, 1);

INSERT INTO Project(Title, Budget, DeptID) VALUES ('Migration Cloud', 100000.00, 1), ('Formation Employés', 20000.00, 2), ('Audit Financier', 50000.00, 3);

SELECT * FROM Departement WHERE DeptID IN (SELECT DeptID FROM Departement WHERE Name IN ('Informatique', 'Finance'));
SELECT * FROM Project WHERE Budget BETWEEN 20.000 AND 100000;
SELECT * FROM Employee WHERE Age IN (28, 30);

SELECT Name, Salary,
CASE
    WHEN Salary<3000.00 THEN 'Bas'
    WHEN Salary BETWEEN 3000.00 AND 5000.00 THEN 'Élevé'
    ELSE 'Moyen'
END AS catégorie_salary
FROM Employee;

SELECT Name, Budget,
CASE
    WHEN Budget<30000.00 THEN 'Petit'
    WHEN Budget BETWEEN 30000.00 AND 70000.00 THEN 'Moyen'
    ELSE 'Grand'
END AS classification_budget
FROM Project;

SELECT Name, Age,
CASE
    WHEN Age<25 THEN 'Junior'
    WHEN Age BETWEEN 25 AND 30 THEN 'Senior'
    ELSE 'Expert'
END AS statut
FROM Employee;

SELECT e.Name, d.Name, e.Salary as Salary,
CASE
    WHEN Salary<3000.00 THEN 'Bas'
    WHEN Salary BETWEEN 3000.00 AND 5000.00 THEN 'Élevé'
    ELSE 'Moyen'
END AS catégorie_salary
FROM employee e JOIN departement d ON e.DeptID = d.DeptID;

SELECT d.Name, COUNT(e.EmpID) as nbr_employee
FROM departement d
JOIN employee e ON d.DeptID = e.DeptID
GROUP By d.Name
HAVING nbr_employee > 2;

SELECT d.Name, AVG(p.Budget) AS Budget_Moyen
FROM project p
JOIN departement d ON p.DeptID = d.DeptID
GROUP BY d.Name
HAVING Budget_Moyen > 30000;