import random
from faker import Faker
from faker.exceptions import UniquenessException

# fake library importing
fake = Faker()
fake.unique.clear()
fake.unique._unique_attempts = 5000

# Constants
NUM_DEPARTMENTS = 100
NUM_INSTRUCTORS = 1000
NUM_COURSES = 1000
NUM_STUDENTS = 10000
NUM_ENROLLMENTS = 50000




# Generating departments ###########################################
departments = []

for department_id in range( 1, NUM_DEPARTMENTS + 1 ):
    name = fake.unique.job()  # using unique job
    office_location = fake.building_number()

    departments.append( (department_id, name, office_location) )




# Generate instructors ####################
instructors = []
unique_instructor_ids = set()

for instructor_id in range(1, NUM_INSTRUCTORS + 1):

    # Changing while loop condition
    if instructor_id in unique_instructor_ids:
        
        instructor_id += 1
        continue
    unique_instructor_ids.add( instructor_id )

    name = fake.unique.name()
    email = fake.unique.email()
    department_id = random.randint( 1, NUM_DEPARTMENTS )
    instructors.append( (instructor_id, name, email, department_id) )

# Generate courses
courses = []
unique_course_titles = set()

for course_id in range( 1, NUM_COURSES + 1 ):
    
    try:
        title = f"Introduction to { fake.unique.word().capitalize() }"  # capitalized response
        
        while title in unique_course_titles:
            title = f"Introduction to { fake.unique.word().capitalize() }"
        
        unique_course_titles.add(title)

    except UniquenessException:
        title = f"Introduction to Random Course { course_id }"
    
    credits = random.randint( 1, 4 )
    department_id = random.randint( 1, NUM_DEPARTMENTS )
    instructor_id = random.randint( 1, NUM_INSTRUCTORS )

    courses.append( (course_id, title, credits, department_id, instructor_id) )

# Generate students
students = []
unique_student_ids = set()

for student_id in range( 1, NUM_STUDENTS + 1 ):
    while student_id in unique_student_ids:
        student_id += 1
    unique_student_ids.add( student_id )

    name = fake.unique.name()
    email = fake.unique.email()
    enrollment_year = random.randint( 2020, 2025 )
    students.append( (student_id, name, email, enrollment_year) )

# Generate enrollments
enrollments = []
unique_enrollment_pairs = set()

for _ in range(NUM_ENROLLMENTS):
    student_id = random.randint( 1, NUM_STUDENTS )
    course_id = random.randint( 1, NUM_COURSES )
    enrollment_pair = ( student_id, course_id )

    while enrollment_pair in unique_enrollment_pairs:
        student_id = random.randint( 1, NUM_STUDENTS )
        course_id = random.randint( 1, NUM_COURSES )
        enrollment_pair = ( student_id, course_id )

    unique_enrollment_pairs.add( enrollment_pair )

    enrollment_date = fake.date_between( start_date="-2y", end_date="today" )
    grade = random.choice([ "A", "B", "C", "D", "F", "Q" ])  # adding q for q drop as well
    enrollments.append( ( student_id, course_id, enrollment_date, grade ) )

# Generate department heads
department_heads = []
unique_instructors_assigned = set()

for department_id in range( 1, NUM_DEPARTMENTS + 1 ):
    instructor_id = random.randint( 1, NUM_INSTRUCTORS )

    # Changed the loop structure
    if instructor_id not in unique_instructors_assigned:
        unique_instructors_assigned.add( instructor_id )
    else:
        while instructor_id in unique_instructors_assigned:
            instructor_id = random.randint( 1, NUM_INSTRUCTORS )

    department_heads.append( (department_id, instructor_id) )


# Save to CSV #############################################################

import csv


def save_to_csv(filename, data, headers):
    with open( filename, "w", newline="" ) as file:
        writer = csv.writer( file )
        writer.writerow( headers )
        writer.writerows( data )

save_to_csv( "departments.csv", departments, ["department_id", "name", "office_location"] )
save_to_csv( "instructors.csv", instructors, ["instructor_id", "name", "email", "department_id"] )
save_to_csv( "courses.csv", courses, ["course_id", "title", "credits", "department_id", "instructor_id"] )
save_to_csv( "students.csv", students, ["student_id", "name", "email", "enrollment_year"] )
save_to_csv( "enrollments.csv", enrollments, ["student_id", "course_id", "enrollment_date", "grade"] )
save_to_csv( "department_heads.csv", department_heads, ["department_id", "instructor_id"] )

print("Data generation complete! Check the CSV files.")
