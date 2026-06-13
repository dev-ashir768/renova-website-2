-- Run in phpMyAdmin after selecting u766839992_renova_db

CREATE TABLE IF NOT EXISTS form_submissions (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(255) NOT NULL,
  email      VARCHAR(255) NOT NULL,
  phone      VARCHAR(50)  DEFAULT NULL,
  project    VARCHAR(100) DEFAULT NULL,
  message    TEXT         NOT NULL,
  page       VARCHAR(50)  DEFAULT 'contact',
  is_read    TINYINT(1)   NOT NULL DEFAULT 0,
  created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);
