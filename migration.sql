CREATE TABLE IF NOT EXISTS schools (
                                       id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                       name VARCHAR(255) NOT NULL,
    pass_strategy enum('avg', 'discard') NOT NULL,
    pass_val INTEGER NOT NULL,
    pass_grade_quantities INTEGER NULL,
    response_type enum('json', 'xml') not null
    );

CREATE TABLE IF NOT EXISTS students (
                                        id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                        name VARCHAR(255) NOT NULL,
    school_id BIGINT UNSIGNED NOT NULL,

    INDEX school_ind(school_id),
    FOREIGN KEY (school_id)
    REFERENCES schools(id)
    );

CREATE TABLE IF NOT EXISTS student_grades (
                                              id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                              student_id BIGINT UNSIGNED NOT NULL,
                                              grade INTEGER UNSIGNED NOT NULL,
                                              subject VARCHAR(30) NOT NULL,

    INDEX student_ind(student_id),
    FOREIGN KEY (student_id)
    references students(id)
    );

INSERT IGNORE into schools (id, name, pass_strategy, pass_val, pass_grade_quantities, response_type)values
    (1,'csm', 'avg', 7, null, 'json'),
    (2, 'csmb', 'discard', 8, 2, 'xml');

INSERT IGNORE INTO students (id, name, school_id) values
    (1, 'John Doe', 1),
    (2, 'John Di', 1),
    (3, 'Tim Cook', 1),
    (4, 'John Doe2', 2),
    (5, 'John Di2', 2),
    (6, 'Tim Cook2', 2);

INSERT IGNORE INTO student_grades (student_id, grade, subject) VALUES
    (1, 7, 'Algebra'),
    (1, 9, 'Biology'),
    (1, 10, 'Mathematics'),
    (2, 6, 'Algebra'),
    (2, 5, 'Biology'),
    (2, 10, 'Mathematics'),
    (3, 7, 'Algebra'),
    (3, 2, 'Biology'),
    (3, 7, 'Mathematics'),
    (4, 9, 'Algebra'),
    (4, 6, 'Biology'),
    (5, 10, 'Mathematics'),
    (6, 3, 'Algebra'),
    (6, 4, 'Biology'),
    (6, 4, 'Mathematics');