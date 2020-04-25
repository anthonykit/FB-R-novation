-- Doctrine Migration File Generated on 2020-04-25 20:21:06

-- Version 20200425141912
ALTER TABLE article3 ADD user_id INT NOT NULL;
ALTER TABLE article3 ADD CONSTRAINT FK_C90170F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);
CREATE INDEX IDX_C90170F8A76ED395 ON article3 (user_id);
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425141912', CURRENT_TIMESTAMP);

-- Version 20200425162355
ALTER TABLE article3 ADD CONSTRAINT FK_C90170F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);
CREATE INDEX IDX_C90170F8A76ED395 ON article3 (user_id);
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425162355', CURRENT_TIMESTAMP);

-- Version 20200425162507
ALTER TABLE article3 DROP user_id;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425162507', CURRENT_TIMESTAMP);

-- Version 20200425162616
ALTER TABLE article3 DROP user_id;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425162616', CURRENT_TIMESTAMP);

-- Version 20200425162810
ALTER TABLE article3 DROP user_id;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425162810', CURRENT_TIMESTAMP);

-- Version 20200425180027
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425180027', CURRENT_TIMESTAMP);

-- Version 20200425180449
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425180449', CURRENT_TIMESTAMP);

-- Version 20200425181719
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL, DROP user_id;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425181719', CURRENT_TIMESTAMP);

-- Version 20200425182014
ALTER TABLE article3 ADD featured_image VARCHAR(255) NOT NULL, DROP user_id;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200425182014', CURRENT_TIMESTAMP);
