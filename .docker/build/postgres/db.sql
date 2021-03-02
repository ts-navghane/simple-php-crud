SELECT 'CREATE DATABASE spc_db'
WHERE NOT EXISTS(SELECT FROM pg_database WHERE datname = 'spc_db')
\gexec

CREATE TABLE IF NOT EXISTS users
(
    id        SERIAL PRIMARY KEY NOT NULL,
    firstname TEXT               NOT NULL,
    lastname  TEXT               NOT NULL
);

CREATE SEQUENCE users_sequence start 1 increment 1;
