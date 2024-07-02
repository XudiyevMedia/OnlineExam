CREATE TABLE tbl_topics (
    topic_id INT AUTO_INCREMENT PRIMARY KEY,
    topic_name VARCHAR(255) NOT NULL,
    topic_description TEXT NOT NULL,
    subject_id INT NOT NULL,
    FOREIGN KEY (subject_id) REFERENCES tbl_subjects(subject_id)
);
