

CREATE TABLE `sri_krishna_bf` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('1','2025-08-04 12:38:22','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a4d344d6a4a664d44453d','4d7a41794c6a553d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('2','2025-08-04 12:38:22','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a4d344d6a4a664d44493d','4d6a413d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('3','2025-08-04 12:38:22','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a4d344d6a4e664d444d3d','4d54413d','1');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('4','2025-08-04 16:32:42','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e444d794e444a664d44513d','4d7a4177','1');


CREATE TABLE `sri_krishna_factory` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `name_location` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `primary_factory` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_factory (id, created_date_time, creator, creator_name, bill_company_id, factory_id, factory_name, lower_case_name, location, name_location, factory_details, primary_factory, deleted) VALUES ('1','2025-08-04 13:20:26','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','55334a704945747961584e6f626d45674a6d4674634473675547466a6132466e6157356e','63334a704947747961584e6f626d45674a6d4674634474686258413749484268593274685a326c755a773d3d','55326c325957746863326c70','55334a704945747961584e6f626d45674a6d4674634473675547466a6132466e6157356e4943685461585a686132467a61576b704943306755326c325957746863326c70','55334a704945747961584e6f626d45674a6d4674634473675547466a6132466e6157356e4a43516b55326c325957746863326c70','1','0');


CREATE TABLE `sri_krishna_godown` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_location` mediumtext NOT NULL,
  `lowercase_name_location` mediumtext NOT NULL,
  `name_mobile_location` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `incharge_name` mediumtext NOT NULL,
  `lowercase_incharge_name` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('1','2025-08-04 14:55:54','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','','4d4451774f4449774d6a55774d6a55314e5452664d44453d','5232396b62336475626d357562673d3d','5a32396b62336475626d357562673d3d','5a6d5a6d','4e5459314e6a59314e6a55314e513d3d','516d397a63324e7959574e725a584a7a63335a72','516d397a633041794d44497a','5232396b62336475626d35756269417449475a6d5a673d3d','5a32396b62336475626d35756269417449475a6d5a673d3d','','5232396b62336475626d35756269516b4a475a6d5a69516b4a456c7559326868636d646c494330675a484e685953416f4e5459314e6a59314e6a55314e536b3d','5a484e6859513d3d','5a484e6859513d3d','4d4451774f4449774d6a55774e4449774d4456664d44453d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('2','2025-08-04 14:59:09','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','','4d4451774f4449774d6a55774d6a55354d446c664d44493d','5a484e6859513d3d','5a484e6859513d3d','5a484e685a413d3d','4d6a457a4d54497a4d54497a4d513d3d','59334a685932746c636e4e6a59584a30596d6c7362413d3d','51334a685932746c636e4e414d7a45794d413d3d','5a484e68595341744947527a5957513d','5a484e68595341744947527a5957513d','','5a484e685953516b4a47527a5957516b4a43524a626d4e6f59584a6e5a53417449484e685a47467a5a43416f4d6a457a4d54497a4d54497a4d536b3d','6332466b59584e6b','6332466b59584e6b','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('3','2025-08-04 15:01:30','4d4451774f4449774d6a55784d4451324d5446664d44453d','','','4d4451774f4449774d6a55774d7a41784d7a42664d444d3d','5a484e685957527a59513d3d','5a484e685957527a59513d3d','5a484e685a47513d','4d6a457a4d54497a4d54497a4d513d3d','59334a685932746c636e4e6a59584a30596d6c736247527a','51334a685932746c636e4e414d7a45794d413d3d','5a484e685957527a595341744947527a5957526b','5a484e685957527a595341744947527a5957526b','','5a484e685957527a5953516b4a47527a5957526b4a43516b5357356a614746795a3255674c53427a59575268633251674b4449784d7a45794d7a45794d7a4570','6332466b59584e6b','6332466b59584e6b','','1');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('4','2025-08-04 17:39:39','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','','4d4451774f4449774d6a55774e544d354d7a6c664d44513d','5132686c626d35686153426e623252766432343d','5932686c626d35686153426e623252766432343d','55335a7263773d3d','4d7a4d7a4d7a4d7a4d7a4d7a4d773d3d','545856306148556762474672','52475632615541784d6a4d3d','5132686c626d35686153426e62325276643234674c534254646d747a','5932686c626d35686153426e62325276643234674c53427a646d747a','','5132686c626d35686153426e623252766432346b4a435254646d747a4a43516b5357356a614746795a3255674c5342455a585a704943677a4d7a4d7a4d7a4d7a4d7a4d7a4b513d3d','5247563261513d3d','5a47563261513d3d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('5','2025-08-04 17:40:17','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','','4d4451774f4449774d6a55774e5451774d5464664d44553d','5132686c626d35686153426e623252766432346764486476','5932686c626d35686153426e623252766432346764486476','5132686c626d356861513d3d','4d7a4d7a4d7a4d7a4d7a4d7a4d773d3d','545856306148556762474672','52475632615541784d6a4d3d','5132686c626d35686153426e623252766432346764486476494330675132686c626d356861513d3d','5932686c626d35686153426e623252766432346764486476494330675932686c626d356861513d3d','','5132686c626d35686153426e6232527664323467644864764a43516b5132686c626d35686153516b4a456c7559326868636d646c49433067524756326153416f4d7a4d7a4d7a4d7a4d7a4d7a4d796b3d','5247563261513d3d','5a47563261513d3d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('6','2025-08-04 17:41:41','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','','4d4451774f4449774d6a55774e5451784e4446664d44593d','5132686c626d35686153426e6232527664323467564768795a57553d','5932686c626d35686153426e6232527664323467644768795a57553d','5132686c626d356861513d3d','4e4451304e4451304e4451304e413d3d','556d46746458563164513d3d','516d397a633041794d44497a','5132686c626d35686153426e6232527664323467564768795a5755674c53424461475675626d4670','5932686c626d35686153426e6232527664323467644768795a5755674c53426a61475675626d4670','','5132686c626d35686153426e6232527664323467564768795a57556b4a43524461475675626d46704a43516b5357356a614746795a3255674c5342735957787064476868494367304e4451304e4451304e4451304b513d3d','624746736158526f59513d3d','624746736158526f59513d3d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','0');


CREATE TABLE `sri_krishna_gsm` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('1','2025-08-04 12:18:55','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a45344e5456664d44453d','4d7a4177','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('2','2025-08-04 12:18:55','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a45344e5456664d44493d','4e544179','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('3','2025-08-04 12:29:26','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a49354d6a5a664d444d3d','4d544977','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('4','2025-08-04 16:35:15','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e444d314d5456664d44513d','4e544177','1');


CREATE TABLE `sri_krishna_login` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `loginer_name` mediumtext NOT NULL,
  `login_date_time` datetime NOT NULL,
  `logout_date_time` datetime DEFAULT NULL,
  `ip_address` mediumtext NOT NULL,
  `browser` mediumtext NOT NULL,
  `os_detail` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('1','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 10:47:35','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('2','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 10:50:07','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('3','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 10:53:58','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('4','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 10:54:32','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('5','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 11:04:18','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('6','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 11:06:00','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('7','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 11:11:18','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('8','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 11:39:22','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('9','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 15:48:57','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('10','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 15:56:34','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('11','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:00:24','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('12','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:05:18','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('13','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:06:10','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('14','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:06:42','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('15','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:06:42','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('16','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:07:00','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('17','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:07:00','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('18','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:51:11','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('19','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 16:56:06','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('20','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 18:33:11','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('21','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-04 18:53:17','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('22','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-05 09:37:41','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('23','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-05 09:41:04','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('24','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','2025-08-05 09:42:09','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d4451774f4449774d6a55784d4451324d5446664d44453d','0');


CREATE TABLE `sri_krishna_role` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `role_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  `incharger` int(11) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('1','2025-08-04 16:20:05','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774e4449774d4456664d44453d','553352685a6d593d','633352685a6d593d','5657357064413d3d,5232396b62336475,55335677634778705a58493d','566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c','0','0');

INSERT INTO sri_krishna_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('2','2025-08-04 16:26:32','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','545746755957646c63673d3d','625746755957646c63673d3d','55326c365a513d3d,52314e4e,5657357064413d3d,5232396b62336475','566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c','0','0');


CREATE TABLE `sri_krishna_size` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, lower_case_name, deleted) VALUES ('1','2025-08-04 11:52:15','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d5455794d5456664d44453d','4d544177','4d544177','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, lower_case_name, deleted) VALUES ('2','2025-08-04 12:19:21','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a45354d6a46664d44493d','4d7a493d','4d7a493d','1');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, lower_case_name, deleted) VALUES ('3','2025-08-04 12:33:17','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a4d7a4d5464664d444d3d','4d6a41774c6a553d','','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, lower_case_name, deleted) VALUES ('4','2025-08-04 12:34:03','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55784d6a4d304d444e664d44513d','4d5441754e513d3d','','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, lower_case_name, deleted) VALUES ('5','2025-08-04 16:26:54','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e4449324e5452664d44553d','4d5441774c6a5577','','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, lower_case_name, deleted) VALUES ('6','2025-08-04 16:26:54','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e4449324e5452664d44593d','4d5441774c6a553d','','1');


CREATE TABLE `sri_krishna_supplier` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `name_mobile_location` mediumtext NOT NULL,
  `supplier_details` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('1','2025-08-04 13:00:57','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55774d5441774e5464664d44453d','5a484e685a475a6b6332593d','5a484e685a475a6b6332593d','4d6a4d794d7a45794d7a45794d773d3d','5a47467a5a413d3d','dsadfdsf (2323123123)','5a484e685a475a6b6332596b4a43526b59584e6b4a43516b4d6a4d794d7a45794d7a45794d773d3d','1');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('2','2025-08-04 13:05:09','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55774d5441314d446c664d44493d','524756326153413d','5a4756326153413d','4d5449784d6a45794d5449784d673d3d','5457466b64584a6861513d3d','Devi  (1212121212)','524756326153416b4a43524e59575231636d46704a43516b4d5449784d6a45794d5449784d673d3d','1');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('3','2025-08-04 13:06:14','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55784d4445334d444e664d44453d','4d4451774f4449774d6a55774d5441324d5452664d444d3d','51574e6f64513d3d','59574e6f64513d3d','4d6a49794d6a49794d6a49794d673d3d','63335a3264673d3d','51574e6f6453416f63335a3264696b674c53427a646e5a32494367794d6a49794d6a49794d6a49794b5341744944597a4d7a4d3159544d794e6a51324e7a4e6b4d32513d','51574e6f6453516b4a484e32646e596b4a4351794d6a49794d6a49794d6a4979','0');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('4','2025-08-04 16:29:51','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e4449354e5446664d44513d','55335677634778705a584967556d46746453416d595731774f773d3d','63335677634778705a584967636d46746453416d595731774f3246746344733d','4e7a6b334e6a51324e4459304e673d3d','63326c325957746863326b674a6d46746344736763334a70646d6b3d','55335677634778705a584967556d46746453416d595731774f79416f63326c325957746863326b674a6d46746344736763334a70646d6b704943306763326c325957746863326b674a6d46746344736763334a70646d6b674b4463354e7a59304e6a51324e445970494330674e6a4d7a4d6a5a6a4d7a49314f5455334e7a51324f44597a4d7a4932596a59334e4745325a4451324e7a51324d7a51304e7a4d324e7a597a4d7a4d30595463774e6a51325a445a694d32513d','55335677634778705a584967556d46746453416d595731774f79516b4a484e70646d467259584e7049435a686258413749484e7961585a704a43516b4e7a6b334e6a51324e4459304e673d3d','0');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('5','2025-08-04 16:39:36','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e444d354d7a5a664d44553d','545856306148553d','625856306148553d','4d7a4d7a4d7a4d7a4d7a4d7a4d773d3d','55326c325957746863326b3d','54585630614855674b464e70646d467259584e704b53417449464e70646d467259584e704943677a4d7a4d7a4d7a4d7a4d7a4d7a4b534174494455314d7a4932597a4d794e546b314e7a63304e6a67324d7a4d794e6d497a5a413d3d','545856306148556b4a43525461585a686132467a6153516b4a444d7a4d7a4d7a4d7a4d7a4d7a4d3d','1');


CREATE TABLE `sri_krishna_unit` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('1','2025-08-04 11:18:59','4d4451774f4449774d6a55784d4451324d5446664d44453d','','','4d4451774f4449774d6a55784d5445344e546c664d44453d','5330647a','6132647a','1');

INSERT INTO sri_krishna_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('2','2025-08-04 11:33:38','4d4451774f4449774d6a55784d4451324d5446664d44453d','','','4d4451774f4449774d6a55784d544d7a4d7a68664d44493d','5132467a5a513d3d','5932467a5a513d3d','0');

INSERT INTO sri_krishna_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('3','2025-08-04 11:33:38','4d4451774f4449774d6a55784d4451324d5446664d44453d','','','4d4451774f4449774d6a55784d544d7a4d7a68664d444d3d','5332633d','6132633d','0');

INSERT INTO sri_krishna_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('4','2025-08-04 16:41:02','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e4451784d444a664d44513d','516d3934','596d3934','0');

INSERT INTO sri_krishna_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('5','2025-08-04 16:56:21','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','4d4451774f4449774d6a55774d5449774d6a5a664d44453d','4d4451774f4449774d6a55774e4455324d6a46664d44553d','55474e7a','63474e7a','0');


CREATE TABLE `sri_krishna_user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `login_id` mediumtext NOT NULL,
  `lower_case_login_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `name_mobile` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `admin` int(100) NOT NULL,
  `type` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('1','2025-08-04 10:46:11','','','4d4451774f4449774d6a55784d4451324d5446664d44453d','NULL','55334a706332396d64486468636d5636','63334a706332396d64486468636d5636','55334a706332396d64486468636d553d','4e4455304e5451314e4455304e513d3d','55334a706332396d64486468636d55674b4451314e4455304e5451314e445570','51575274615734784d6a4e41','1','Super Admin','NULL','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('2','2025-08-04 16:07:35','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774e4441334d7a5a664d44493d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','5a47563261513d3d','5a47563261513d3d','5247563261513d3d','4e6a55304e6a51324e4459304e673d3d','524756326153416f4e6a55304e6a51324e4459304e696b3d','52475632615541784d6a4d3d','0','Staff','NULL','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('3','2025-08-04 16:08:21','4d4451774f4449774d6a55784d4451324d5446664d44453d','','4d4451774f4449774d6a55774e4441344d6a46664d444d3d','4d4451774f4449774d6a55774e4449774d4456664d44453d','59334a685932733d','59334a685932733d','5247563261513d3d','4d6a4d794d7a45794d7a45794d773d3d','524756326153416f4d6a4d794d7a45794d7a45794d796b3d','52475632615541784d6a4d3d','0','Staff','NULL','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('6','2025-08-04 17:40:17','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','4d4451774f4449774d6a55774e5451774d5468664d44593d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','545856306148556762474672','625856306148556762474672','5247563261513d3d','4d7a4d7a4d7a4d7a4d7a4d7a4d773d3d','524756326153416f4d7a4d7a4d7a4d7a4d7a4d7a4d796b3d','52475632615541784d6a4d3d','0','Staff','4d4451774f4449774d6a55774e5451774d5464664d44553d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('7','2025-08-04 17:41:41','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d553d','4d4451774f4449774d6a55774e5451784e4446664d44633d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','556d467464513d3d','636d467464513d3d','5247563261513d3d','4e4451304e4451304e4451304e413d3d','524756326153416f4e4451304e4451304e4451304e436b3d','516d397a633041794d44497a','0','Staff','4d4451774f4449774d6a55774e5451784e4446664d44593d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('8','0000-00-00 00:00:00','','55334a706332396d64486468636d553d','4d4451774f4449774d6a55774e5451794d545a664d44673d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','556d46746458563164513d3d','636d46746458563164513d3d','5247563261513d3d','4e4451304e4451304e4451304e413d3d','524756326153416f4e4451304e4451304e4451304e436b3d','516d397a633041794d44497a','0','Staff','','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('9','0000-00-00 00:00:00','','55334a706332396d64486468636d553d','4d4451774f4449774d6a55774e5451794d7a42664d446b3d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','556d46746458563164513d3d','636d46746458563164513d3d','624746736158526f59513d3d','4e4451304e4451304e4451304e413d3d','624746736158526f5953416f4e4451304e4451304e4451304e436b3d','516d397a633041794d44497a','0','Staff','','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('10','0000-00-00 00:00:00','','55334a706332396d64486468636d553d','4d4451774f4449774d6a55774e5451794e445a664d54413d','4d4451774f4449774d6a55774e4449324d7a4a664d44493d','556d46746458563164513d3d','636d46746458563164513d3d','624746736158526f59513d3d','4e4451304e4451304e4451304e413d3d','624746736158526f5953416f4e4451304e4451304e4451304e436b3d','516d397a633041794d44497a','0','Staff','','0');
