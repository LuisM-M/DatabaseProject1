import random
from faker import Faker
from faker.exceptions import UniquenessException

# Initialize Faker for random names, emails, etc.
fake = Faker()

# Clear any previously stored unique values
fake.unique.clear()

# Increase the unique attempt limit to avoid frequent errors
fake.unique._unique_attempts = 5000

# Parameters
NUM_DEPARTMENTS = 100
NUM_INSTRUCTORS = 1000
NUM_COURSES = 1000
NUM_STUDENTS = 10000
NUM_ENROLLMENTS = 50000

# Generate Departments
departments = []
for dept_id in range(1, NUM_DEPARTMENTS + 1):
    name = fake.unique.job()  # Random department name
    office_location = fake.building_number()  # Random office location
    departments.append((dept_id, name, office_location))

# Generate Instructors
instructors = []
unique_instructor_ids = set()  # To track unique instructor IDs
for instructor_id in range(1, NUM_INSTRUCTORS + 1):
    # Ensure no duplicates in instructor_id
    while instructor_id in unique_instructor_ids:
        instructor_id += 1
    unique_instructor_ids.add(instructor_id)

    name = fake.unique.name()  # Random instructor name
    email = fake.unique.email()  # Random email
    dept_id = random.randint(1, NUM_DEPARTMENTS)  # Random department
    instructors.append((instructor_id, name, email, dept_id))

# Generate Courses
courses = []
unique_course_titles = set()  # To track unique course titles
for course_id in range(1, NUM_COURSES + 1):
    try:
        title = f"Introduction to {fake.unique.word().capitalize()}"  # Random course title
        # Ensure course title is unique
        while title in unique_course_titles:
            title = f"Introduction to {fake.unique.word().capitalize()}"
        unique_course_titles.add(title)
    except UniquenessException:
        # Handle case where Faker can't generate more unique words
        title = f"Introduction to Random Course {course_id}"
    credits = random.randint(1, 4)  # Random credits (1–4)
    dept_id = random.randint(1, NUM_DEPARTMENTS)  # Random department
    instructor_id = random.randint(1, NUM_INSTRUCTORS)  # Random instructor
    courses.append((course_id, title, credits, dept_id, instructor_id))

# Generate Students
students = []
unique_student_ids = set()  # To track unique student IDs
for student_id in range(1, NUM_STUDENTS + 1):
    # Ensure no duplicates in student_id
    while student_id in unique_student_ids:
        student_id += 1
    unique_student_ids.add(student_id)

    name = fake.unique.name()  # Random student name
    email = fake.unique.email()  # Random email
    enrollment_year = random.randint(2020, 2025)  # Random enrollment year
    students.append((student_id, name, email, enrollment_year))

# Generate Enrollments
enrollments = []
unique_enrollment_pairs = set()  # To track unique student-course combinations
for _ in range(NUM_ENROLLMENTS):
    student_id = random.randint(1, NUM_STUDENTS)  # Random student
    course_id = random.randint(1, NUM_COURSES)  # Random course
    enrollment_pair = (student_id, course_id)

    # Ensure no duplicates in enrollments (same student, same course)
    while enrollment_pair in unique_enrollment_pairs:
        student_id = random.randint(1, NUM_STUDENTS)
        course_id = random.randint(1, NUM_COURSES)
        enrollment_pair = (student_id, course_id)

    unique_enrollment_pairs.add(enrollment_pair)

    enrollment_date = fake.date_between(start_date="-2y", end_date="today")  # Random date
    grade = random.choice(["A", "B", "C", "D", "F"])  # Random grade
    enrollments.append((student_id, course_id, enrollment_date, grade))

# Generate Department Heads
department_heads = []
unique_instructors_assigned = set()  # Track instructors already assigned as department heads
for dept_id in range(1, NUM_DEPARTMENTS + 1):
    # Ensure unique instructor_id per department head
    instructor_id = random.randint(1, NUM_INSTRUCTORS)

    # Ensure that instructor_id is not already assigned to another department
    while instructor_id in unique_instructors_assigned:
        instructor_id = random.randint(1, NUM_INSTRUCTORS)

    unique_instructors_assigned.add(instructor_id)
    department_heads.append((dept_id, instructor_id))

# Save data to CSV files (or directly insert into the database)
import csv

def save_to_csv(filename, data, headers):
    with open(filename, "w", newline="") as file:
        writer = csv.writer(file)
        writer.writerow(headers)
        writer.writerows(data)

save_to_csv("departments.csv", departments, ["dept_id", "name", "office_location"])
save_to_csv("instructors.csv", instructors, ["instructor_id", "name", "email", "dept_id"])
save_to_csv("courses.csv", courses, ["course_id", "title", "credits", "dept_id", "instructor_id"])
save_to_csv("students.csv", students, ["student_id", "name", "email", "enrollment_year"])
save_to_csv("enrollments.csv", enrollments, ["student_id", "course_id", "enrollment_date", "grade"])
save_to_csv("department_heads.csv", department_heads, ["dept_id", "instructor_id"])

print("Data generation complete! Check the CSV files.")
