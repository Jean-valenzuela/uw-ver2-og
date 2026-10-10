CREATE TABLE IF NOT EXISTS account_security (
 user_id INT NOT NULL PRIMARY KEY,
 auth_version INT NOT NULL DEFAULT 0,
 CONSTRAINT account_security_user FOREIGN KEY(user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS password_reset_tokens (
 token_hash CHAR(64) NOT NULL PRIMARY KEY,
 user_id INT NOT NULL,
 expires_at DATETIME NOT NULL,
 used_at DATETIME NULL,
 created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 delivery_status VARCHAR(20) NOT NULL DEFAULT 'pending',
 INDEX reset_user(user_id),
 CONSTRAINT password_reset_user FOREIGN KEY(user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS password_reset_limits (
 rate_key CHAR(64) NOT NULL PRIMARY KEY,
 attempts INT NOT NULL,
 window_start DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
