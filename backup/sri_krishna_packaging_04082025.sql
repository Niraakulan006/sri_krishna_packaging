

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('1','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44453d','4d7a413d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('2','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44493d','4d6a6b3d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('3','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d444d3d','4d6a673d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('4','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44513d','4d6a633d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('5','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44553d','4d6a593d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('6','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44593d','4d6a553d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('7','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44633d','4d6a513d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('8','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d44673d','4d6a4d3d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('9','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d446b3d','4d6a493d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('10','2025-08-14 15:29:39','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','0');

INSERT INTO sri_krishna_bf (id, created_date_time, creator, creator_name, bill_company_id, bf_id, bf_name, deleted) VALUES ('11','2025-08-14 15:31:27','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a4d784d6a64664d54453d','4d7a4577','1');


CREATE TABLE `sri_krishna_consumption_entry` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `consumption_entry_id` mediumtext NOT NULL,
  `consumption_entry_date` date NOT NULL,
  `consumption_entry_number` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_consumption_entry (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, bill_company_name, bill_company_details, consumption_entry_id, consumption_entry_date, consumption_entry_number, factory_id, factory_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, quantity, total_quantity, remarks, cancelled, deleted) VALUES ('1','2025-08-18 16:07:29','2025-08-18 16:07:29','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','55334a704945747961584e6f626d45675547466a6132466e6157356e4a43516b55326c325957746863326b3d','4d5467774f4449774d6a55774e4441334d6a6c664d44453d','2025-08-18','CE001/25-26','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e4943685461585a686132467a61536b674c53425461585a686132467a61513d3d','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','5','5','.','0','0');


CREATE TABLE `sri_krishna_conversion` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `bill_id` mediumtext NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `conversion_id` mediumtext NOT NULL,
  `conversion_number` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `request_qty` mediumtext NOT NULL,
  `delivery_qty` mediumtext NOT NULL,
  `inward_qty` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_conversion (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, bill_date, bill_type, bill_id, bill_number, conversion_id, conversion_number, godown_id, godown_name, factory_id, factory_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, request_qty, delivery_qty, inward_qty, deleted) VALUES ('1','2025-08-18 13:01:54','2025-08-18 13:01:54','4d5451774f4449774d6a55774d5445334e4464664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','2025-08-18','Stock Request','4d5467774f4449774d6a55774d5441784e5452664d44453d','STR001/25-26','NULL','NULL','4d5451774f4449774d6a55774d7a51334e4442664d44593d','5548563061485567554856795958526a61476b675232396b62336475','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','10','NULL','NULL','0');


CREATE TABLE `sri_krishna_delivery_slip` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `delivery_slip_id` mediumtext NOT NULL,
  `delivery_slip_number` mediumtext NOT NULL,
  `stock_request_id` mediumtext NOT NULL,
  `stock_request_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `godown_name_location` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `factory_name_location` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `is_approved` int(100) NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `sri_krishna_factory` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
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


INSERT INTO sri_krishna_factory (id, created_date_time, creator, creator_name, factory_id, factory_name, lower_case_name, location, name_location, factory_details, primary_factory, deleted) VALUES ('1','2025-08-14 15:19:44','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','63334a704947747961584e6f626d45676347466a6132466e6157356e','55326c325957746863326b3d','55334a704945747961584e6f626d45675547466a6132466e6157356e4943685461585a686132467a61536b674c53425461585a686132467a61513d3d','55334a704945747961584e6f626d45675547466a6132466e6157356e4a43516b55326c325957746863326b3d','1','0');


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


INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('1','2025-08-14 15:41:31','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','','4d5451774f4449774d6a55774d7a51784d7a46664d44453d','5157463061476c6a6148566b61534254644739795a57687664584e6c','5957463061476c6a6148566b6153427a644739795a57687664584e6c','55326c325957746863326b3d','4f5441344f446b774f5441344d413d3d','5233567559513d3d','51575274615734784d6a4e41','5157463061476c6a6148566b61534254644739795a57687664584e6c4943306755326c325957746863326b3d','5957463061476c6a6148566b6153427a644739795a57687664584e6c4943306763326c325957746863326b3d','','5157463061476c6a6148566b61534254644739795a57687664584e6c4a43516b55326c325957746863326b6b4a43524a626d4e6f59584a6e5a53417449456431626d45674b446b774f4467354d446b774f444170','5233567559513d3d','5a33567559513d3d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('2','2025-08-14 15:43:46','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','','4d5451774f4449774d6a55774d7a517a4e445a664d44493d','566d5630636d6b67566d46316248513d','646d5630636d6b67646d46316248513d','55326c325957746863326b3d','4d446b344d446b344d446b344f513d3d','553256756447687062413d3d','51575274615734784d6a4e41','566d5630636d6b67566d4631624851674c53425461585a686132467a61513d3d','646d5630636d6b67646d4631624851674c53427a61585a686132467a61513d3d','','566d5630636d6b67566d46316248516b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306755325675644768706243416f4d446b344d446b344d446b344f536b3d','553256756447687062413d3d','633256756447687062413d3d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('3','2025-08-14 15:44:17','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','','4d5451774f4449774d6a55774d7a51304d5464664d444d3d','55473975626d6b6752334a68626d467965513d3d','63473975626d6b675a334a68626d467965513d3d','55326c325957746863326b3d','4d446b344f5463344e7a67354e773d3d','566d567364513d3d','51575274615734784d6a4e41','55473975626d6b6752334a68626d46796553417449464e70646d467259584e70','63473975626d6b675a334a68626d46796553417449484e70646d467259584e70','','55473975626d6b6752334a68626d46796553516b4a464e70646d467259584e704a43516b5357356a614746795a3255674c5342575a577831494367774f5467354e7a67334f446b334b513d3d','566d567364513d3d','646d567364513d3d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('4','2025-08-14 15:44:54','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','','4d5451774f4449774d6a55774d7a51304e5452664d44513d','5458563061485567545746755a4746775957306755335276636d553d','6258563061485567625746755a4746775957306763335276636d553d','55326c325957746863326b3d','4f5467334f446b334f446b334f413d3d','5647686862574a70','51575274615734784d6a4e41','5458563061485567545746755a4746775957306755335276636d55674c53425461585a686132467a61513d3d','6258563061485567625746755a4746775957306763335276636d55674c53427a61585a686132467a61513d3d','','5458563061485567545746755a4746775957306755335276636d556b4a43525461585a686132467a6153516b4a456c7559326868636d646c494330675647686862574a70494367354f4463344f5463344f5463344b513d3d','5647686862574a70','6447686862574a70','4d5451774f4449774d6a55774d7a51774e546c664d44453d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('5','2025-08-14 15:46:08','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','','4d5451774f4449774d6a55774d7a51324d4468664d44553d','56476868626d6468625342556147393064476b67524756776233513d','64476868626d6468625342306147393064476b675a4756776233513d','55326c325957746863326b3d','4f5467334f446b334f446b334f513d3d','5157356964513d3d','51575274615734784d6a4e41','56476868626d6468625342556147393064476b6752475677623351674c53425461585a686132467a61513d3d','64476868626d6468625342306147393064476b675a475677623351674c53427a61585a686132467a61513d3d','','56476868626d6468625342556147393064476b67524756776233516b4a43525461585a686132467a6153516b4a456c7559326868636d646c49433067515735696453416f4f5467334f446b334f446b334f536b3d','5157356964513d3d','5957356964513d3d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','0');

INSERT INTO sri_krishna_godown (id, created_date_time, creator, creator_name, bill_company_id, godown_id, godown_name, lower_case_name, location, mobile_number, user_id, password, name_location, lowercase_name_location, name_mobile_location, godown_details, incharge_name, lowercase_incharge_name, role_id, deleted) VALUES ('6','2025-08-14 15:47:40','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','','4d5451774f4449774d6a55774d7a51334e4442664d44593d','5548563061485567554856795958526a61476b675232396b62336475','6348563061485567634856795958526a61476b675a32396b62336475','55326c325957746863326b3d','4f5467334f5463354f4463354f413d3d','556d46715957343d','51575274615734784d6a4e41','5548563061485567554856795958526a61476b675232396b623364754943306755326c325957746863326b3d','6348563061485567634856795958526a61476b675a32396b623364754943306763326c325957746863326b3d','','5548563061485567554856795958526a61476b675232396b623364754a43516b55326c325957746863326b6b4a43524a626d4e6f59584a6e5a53417449464a68616d4675494367354f4463354e7a6b344e7a6b344b513d3d','556d46715957343d','636d46715957343d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('1','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44453d','4d544177','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('2','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44493d','4f54413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('3','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d444d3d','4f44413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('4','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44513d','4e7a413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('5','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44553d','4e6a413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('6','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44593d','4e54413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('7','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44633d','4e44413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('8','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d44673d','4d7a413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('9','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d446b3d','4d6a413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('10','2025-08-14 15:26:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','0');

INSERT INTO sri_krishna_gsm (id, created_date_time, creator, creator_name, bill_company_id, gsm_id, gsm_name, deleted) VALUES ('11','2025-08-14 15:30:30','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a4d774d7a42664d54453d','4d513d3d','1');


CREATE TABLE `sri_krishna_inward_approval` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `inward_approval_id` mediumtext NOT NULL,
  `inward_approval_number` mediumtext NOT NULL,
  `delivery_slip_id` mediumtext NOT NULL,
  `delivery_slip_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `godown_name_location` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `factory_name_location` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `sri_krishna_inward_material` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `inward_material_id` mediumtext NOT NULL,
  `inward_material_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name` mediumtext NOT NULL,
  `supplier_details` mediumtext NOT NULL,
  `location_type` mediumtext NOT NULL,
  `godown_type` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_inward_material (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, bill_company_name, bill_company_details, inward_material_id, inward_material_number, bill_date, bill_number, supplier_id, supplier_name, supplier_details, location_type, godown_type, godown_id, godown_name, factory_id, factory_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, quantity, total_quantity, cancelled, deleted) VALUES ('1','2025-08-18 13:48:30','2025-08-18 13:48:30','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','55334a704945747961584e6f626d45675547466a6132466e6157356e4a43516b55326c325957746863326b3d','4d5467774f4449774d6a55774d5451344d7a42664d44453d','INW001/25-26','2025-08-18','4f5441344d446b34','4d5451774f4449774d6a55774e4441324d7a68664d44553d','54585630614856775957356b61513d3d','54585630614856775957356b6153516b4a4531685a48567959576b6b4a4351344f5463354f5441774f544135','2','NULL','NULL','NULL','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e4943685461585a686132467a61536b674c53425461585a686132467a61513d3d','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','20','20','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('1','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-14 13:17:52','2025-08-14 13:17:52','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('2','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-14 13:21:13','2025-08-14 13:21:13','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('3','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-14 15:23:12','2025-08-14 15:23:12','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('4','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-14 15:50:14','2025-08-14 15:50:14','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('5','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 10:08:56','2025-08-18 10:08:56','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('6','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 13:00:54','2025-08-18 13:00:54','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('7','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 15:07:37','2025-08-18 15:07:37','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('8','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 15:09:51','2025-08-18 15:09:51','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('9','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 15:11:56','2025-08-18 15:11:59','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('10','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 15:52:10','2025-08-18 15:52:10','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('11','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 17:25:01','2025-08-18 17:25:01','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');

INSERT INTO sri_krishna_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('12','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-08-18 18:32:49','2025-08-18 18:32:49','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64','Super Admin','4d5451774f4449774d6a55774d5445334e4464664d44453d','0');


CREATE TABLE `sri_krishna_material_transfer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `material_transfer_id` mediumtext NOT NULL,
  `material_transfer_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `factory_name_location` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `godown_name_location` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_material_transfer (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, bill_company_name, bill_company_details, material_transfer_id, material_transfer_number, bill_date, factory_id, factory_name, factory_name_location, godown_id, godown_name, godown_name_location, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, quantity, total_quantity, cancelled, deleted) VALUES ('1','2025-08-18 15:52:48','2025-08-18 15:52:48','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','55334a704945747961584e6f626d45675547466a6132466e6157356e4a43516b55326c325957746863326b3d','4d5467774f4449774d6a55774d7a55794e4468664d44453d','MAT001/25-26','2025-08-18','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','55334a704945747961584e6f626d45675547466a6132466e6157356e4943685461585a686132467a61536b674c53425461585a686132467a61513d3d','4d5451774f4449774d6a55774d7a51334e4442664d44593d','5548563061485567554856795958526a61476b675232396b62336475','5548563061485567554856795958526a61476b675232396b623364754943306755326c325957746863326b3d','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','10','10','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('1','2025-08-14 15:40:59','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a51774e546c664d44453d','5232396b6233647549456c7559326868636d646c','5a32396b6233647549476c7559326868636d646c','5657357064413d3d','566d6c6c64773d3d','0','0');


CREATE TABLE `sri_krishna_size` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('1','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44453d','4d6a4177','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('2','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44493d','4d546b77','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('3','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d444d3d','4d546777','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('4','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44513d','4d546377','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('5','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44553d','4d545977','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('6','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44593d','4d545577','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('7','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44633d','4d545177','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('8','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d44673d','4d544d77','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('9','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d446b3d','4d544977','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('10','2025-08-14 15:25:56','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','0');

INSERT INTO sri_krishna_size (id, created_date_time, creator, creator_name, bill_company_id, size_id, size_name, deleted) VALUES ('11','2025-08-14 15:29:53','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774d7a49354e544e664d54453d','4d544578','1');


CREATE TABLE `sri_krishna_stock` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `stock_date` date NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `inward_unit` mediumtext NOT NULL,
  `outward_unit` mediumtext NOT NULL,
  `stock_type` mediumtext NOT NULL,
  `stock_action` mediumtext NOT NULL,
  `bill_unique_id` mediumtext NOT NULL,
  `bill_unique_number` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_stock (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, stock_date, supplier_id, supplier_name, factory_id, factory_name, godown_id, godown_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('1','2025-08-18 13:48:30','2025-08-18 13:48:30','4d5451774f4449774d6a55774d5445334e4464664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','2025-08-18','4d5451774f4449774d6a55774e4441324d7a68664d44553d','54585630614856775957356b61513d3d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','NULL','NULL','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','20','0','Inward Material','Plus','4d5467774f4449774d6a55774d5451344d7a42664d44453d','INW001/25-26','4f5441344d446b34','0');

INSERT INTO sri_krishna_stock (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, stock_date, supplier_id, supplier_name, factory_id, factory_name, godown_id, godown_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('2','2025-08-18 15:52:48','2025-08-18 15:52:48','4d5451774f4449774d6a55774d5445334e4464664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','2025-08-18','NULL','NULL','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','NULL','NULL','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','0','10','Material Transfer','Minus','4d5467774f4449774d6a55774d7a55794e4468664d44453d','MAT001/25-26','545546554d4441784c7a49314c544932','0');

INSERT INTO sri_krishna_stock (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, stock_date, supplier_id, supplier_name, factory_id, factory_name, godown_id, godown_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('3','2025-08-18 15:52:48','2025-08-18 15:52:48','4d5451774f4449774d6a55774d5445334e4464664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','2025-08-18','NULL','NULL','NULL','NULL','4d5451774f4449774d6a55774d7a51334e4442664d44593d','5548563061485567554856795958526a61476b675232396b62336475','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','10','0','Material Transfer','Plus','4d5467774f4449774d6a55774d7a55794e4468664d44453d','MAT001/25-26','545546554d4441784c7a49314c544932','0');

INSERT INTO sri_krishna_stock (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, stock_date, supplier_id, supplier_name, factory_id, factory_name, godown_id, godown_name, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('4','2025-08-18 16:07:29','2025-08-18 16:07:29','4d5451774f4449774d6a55774d5445334e4464664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','2025-08-18','NULL','NULL','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','NULL','NULL','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','0','5','Consumption Entry','Minus','4d5467774f4449774d6a55774e4441334d6a6c664d44453d','CE001/25-26','513055774d4445764d6a55744d6a593d','0');


CREATE TABLE `sri_krishna_stock_adjustment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `stock_adjustment_id` mediumtext NOT NULL,
  `stock_adjustment_number` mediumtext NOT NULL,
  `stock_adjustment_date` date NOT NULL,
  `remarks` mediumtext NOT NULL,
  `location_type` mediumtext NOT NULL,
  `godown_type` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `stock_type` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `sri_krishna_stock_request` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_name` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `stock_request_id` mediumtext NOT NULL,
  `stock_request_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `godown_name_location` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `factory_name_location` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `size_id` mediumtext NOT NULL,
  `size_name` mediumtext NOT NULL,
  `gsm_id` mediumtext NOT NULL,
  `gsm_name` mediumtext NOT NULL,
  `bf_id` mediumtext NOT NULL,
  `bf_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `is_deliveried` int(100) NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_stock_request (id, created_date_time, updated_date_time, creator, creator_name, bill_company_id, bill_company_name, bill_company_details, stock_request_id, stock_request_number, bill_date, godown_id, godown_name, godown_name_location, factory_id, factory_name, factory_name_location, remarks, size_id, size_name, gsm_id, gsm_name, bf_id, bf_name, quantity, total_quantity, is_deliveried, cancelled, deleted) VALUES ('1','2025-08-18 13:01:54','2025-08-18 13:01:54','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','55334a704945747961584e6f626d45675547466a6132466e6157356e4a43516b55326c325957746863326b3d','4d5467774f4449774d6a55774d5441784e5452664d44453d','STR001/25-26','2025-08-18','4d5451774f4449774d6a55774d7a51334e4442664d44593d','5548563061485567554856795958526a61476b675232396b62336475','5548563061485567554856795958526a61476b675232396b623364754943306755326c325957746863326b3d','4d5451774f4449774d6a55774d7a45354e4452664d44453d','55334a704945747961584e6f626d45675547466a6132466e6157356e','55334a704945747961584e6f626d45675547466a6132466e6157356e4943685461585a686132467a61536b674c53425461585a686132467a61513d3d','4c673d3d','4d5451774f4449774d6a55774d7a49314e545a664d54413d','4d544577','4d5451774f4449774d6a55774d7a49324e544a664d54413d','4d54413d','4d5451774f4449774d6a55774d7a49354d7a6c664d54413d','4d6a453d','10','10','0','0','0');


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


INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('1','2025-08-14 16:02:52','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774e4441794e544a664d44453d','5248567959576b6755326c755a324674','5a48567959576b6763326c755a324674','4f5467354e7a67354e7a67354f413d3d','546d5673624739795a537767564768766233526f645774315a476b3d','5248567959576b6755326c755a32467449433067546d5673624739795a537767564768766233526f645774315a476b674b446b344f5463344f5463344f546770','5248567959576b6755326c755a3246744a43516b546d5673624739795a537767564768766233526f645774315a476b6b4a4351354f446b334f446b334f446b34','0');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('2','2025-08-14 16:03:09','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774e44417a4d446c664d44493d','566d56736453424f59576c6a61325679','646d56736453427559576c6a61325679','4f5441344f5463344f5463354f413d3d','54585674596d4670','566d56736453424f59576c6a613256794943306754585674596d4670494367354d4467354e7a67354e7a6b344b513d3d','566d56736453424f59576c6a613256794a43516b54585674596d46704a43516b4f5441344f5463344f5463354f413d3d','0');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('3','2025-08-14 16:03:26','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774e44417a4d6a5a664d444d3d','556d56755a32467959586c6849464e686133526f61585a6c62413d3d','636d56755a32467959586c6849484e686133526f61585a6c62413d3d','4f446b334f446b334f446b334f413d3d','5247567361476b3d','556d56755a32467959586c6849464e686133526f61585a6c624341744945526c62476870494367344f5463344f5463344f5463344b513d3d','556d56755a32467959586c6849464e686133526f61585a6c6243516b4a45526c624768704a43516b4f446b334f446b334f446b334f413d3d','0');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('4','2025-08-14 16:05:31','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774e4441314d7a46664d44513d','5332397261326b67533356745958493d','6132397261326b67613356745958493d','4f5467334f446b334f446b334f413d3d','5548566b614856775a58523059576b7349454e6f5a57357559576b3d','5332397261326b6753335674595849674c5342516457526f6458426c64485268615377675132686c626d35686153416f4f5467334f446b334f446b334f436b3d','5332397261326b67533356745958496b4a4352516457526f6458426c64485268615377675132686c626d35686153516b4a446b344e7a67354e7a67354e7a673d','0');

INSERT INTO sri_krishna_supplier (id, created_date_time, creator, creator_name, bill_company_id, supplier_id, supplier_name, lower_case_name, mobile_number, location, name_mobile_location, supplier_details, deleted) VALUES ('5','2025-08-14 16:06:38','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774e4441324d7a68664d44553d','54585630614856775957356b61513d3d','62585630614856775957356b61513d3d','4f446b334f546b774d446b774f513d3d','5457466b64584a6861513d3d','54585630614856775957356b61534174494531685a48567959576b674b4467354e7a6b354d4441354d446b70','54585630614856775957356b6153516b4a4531685a48567959576b6b4a4351344f5463354f5441774f544135','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO sri_krishna_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('1','2025-08-14 18:12:35','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a45354e4452664d44453d','4d5451774f4449774d6a55774e6a45794d7a56664d44453d','546d397a','626d397a','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('1','2025-08-14 13:17:47','4d4451774f4449774d6a55784d4451324d5446664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d5445334e4464664d44453d','NULL','55334a706332396d64486468636d5636','63334a706332396d64486468636d5636','55334a706332396d64486468636d5636','4f5459794f546b314d4441774d513d3d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','51575274615734784d6a4e41','1','Super Admin','NULL','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('2','2025-08-14 15:41:31','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a51784d7a46664d44493d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','5233567559513d3d','5a33567559513d3d','5233567559513d3d','4f5441344f446b774f5441344d413d3d','523356755953416f4f5441344f446b774f5441344d436b3d','51575274615734784d6a4e41','0','Godown Incharge','4d5451774f4449774d6a55774d7a51784d7a46664d44453d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('3','2025-08-14 15:43:46','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a517a4e445a664d444d3d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','553256756447687062413d3d','633256756447687062413d3d','553256756447687062413d3d','4d446b344d446b344d446b344f513d3d','55325675644768706243416f4d446b344d446b344d446b344f536b3d','51575274615734784d6a4e41','0','Godown Incharge','4d5451774f4449774d6a55774d7a517a4e445a664d44493d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('4','2025-08-14 15:44:17','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a51304d5464664d44513d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','566d567364513d3d','646d567364513d3d','566d567364513d3d','4d446b344f5463344e7a67354e773d3d','566d56736453416f4d446b344f5463344e7a67354e796b3d','51575274615734784d6a4e41','0','Godown Incharge','4d5451774f4449774d6a55774d7a51304d5464664d444d3d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('5','2025-08-14 15:44:54','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a51304e5452664d44553d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','5647686862574a70','6447686862574a70','5647686862574a70','4f5467334f446b334f446b334f413d3d','5647686862574a70494367354f4463344f5463344f5463344b513d3d','51575274615734784d6a4e41','0','Godown Incharge','4d5451774f4449774d6a55774d7a51304e5452664d44513d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('6','2025-08-14 15:46:08','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a51324d4468664d44593d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','5157356964513d3d','5957356964513d3d','5157356964513d3d','4f5467334f446b334f446b334f513d3d','515735696453416f4f5467334f446b334f446b334f536b3d','51575274615734784d6a4e41','0','Godown Incharge','4d5451774f4449774d6a55774d7a51324d4468664d44553d','0');

INSERT INTO sri_krishna_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, godown_id, deleted) VALUES ('7','2025-08-14 15:47:40','4d5451774f4449774d6a55774d5445334e4464664d44453d','55334a706332396d64486468636d5636','4d5451774f4449774d6a55774d7a51334e4442664d44633d','4d5451774f4449774d6a55774d7a51774e546c664d44453d','556d46715957343d','636d46715957343d','556d46715957343d','4f5467334f5463354f4463354f413d3d','556d4671595734674b446b344e7a6b334f5467334f546770','51575274615734784d6a4e41','0','Godown Incharge','4d5451774f4449774d6a55774d7a51334e4442664d44593d','0');
