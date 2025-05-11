function calculateTotalSalary(dep,employees){
    let total = 0;
    for(let i=0; i<employees.length; i++){
        if(employees[i].department === dep){
            total+=employees[i].salary;
        }
    }

    return total
}

function calculateTotalSalaryByDepartment(employees){

    let EmployeesByDepartment = {}

    for(let i = 0; i< employees.length; i++){
        EmployeesByDepartment[employees[i].department] =  calculateTotalSalary(employees[i].department, employees)
    }

    return EmployeesByDepartment
}
console.log(calculateTotalSalaryByDepartment(employees));

