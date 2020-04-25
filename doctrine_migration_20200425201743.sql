-- Doctrine Migration File Generated on 2020-04-25 20:17:43

-- Version 20200425141912

-- Version 20200425180027
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425180027', CURRENT_TIMESTAMP);

-- Version 20200425180449
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425180449', CURRENT_TIMESTAMP);

-- Version 20200425181719
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL, DROP user_id;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425181719', CURRENT_TIMESTAMP);
