<?php
// Server Name
defined('DB_HOST') || define('DB_HOST','localhost');
// Database Username
defined('DB_USERNAME') || define('DB_USERNAME','root');
// Database Password
defined('DB_PASSWORD') || define('DB_PASSWORD','');
// Database Name
defined('DB_NAME') || define('DB_NAME','medical_test');

// Connect to Database Server 
$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

// Settins Table
$sql = "create table if not exists `settings` (
    `setting_id` int(11) unsigned not null primary key auto_increment,
    `setting_name` varchar(100) not null,
    `setting_type` varchar(100) not null,
    `setting_value` varchar(255),
    `setting_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// Users Table
$sql = "create table if not exists `users` (
    `user_id` int(11) unsigned not null primary key auto_increment,
    `user_name` varchar(100) not null,
    `user_email` varchar(100) not null unique,
    `user_password` varchar(255) not null,
    `user_gender` enum('male','female') not null,
    `user_phone` varchar(20),
    `user_age` varchar(3),
    `user_image` varchar(255),
    `user_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// Pages Table
$sql = "create table if not exists `pages` (
    `page_id` integer unsigned not null primary key auto_increment,
    `page_name` varchar(20) not null,
    `page_link` varchar(20) ,
    `page_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// Sliders Table
$sql = "create table if not exists `sliders` (
    `slider_id` int(11) unsigned not null primary key auto_increment,
    `slider_heading` varchar(60) not null,
    `slider_description` varchar(255) not null,
    `slider_image` varchar(255) not null,
    `slider_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// Services_type Table
$sql = "create table if not exists `service_types` (
    `service_type_id` int(11) unsigned not null primary key auto_increment,
    `service_type_name` varchar(100) not null,
    `service_type_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// Services Table
$sql = "create table if not exists `services` (
    `service_id` int(11) unsigned not null primary key auto_increment,
    `service_name` varchar(30) not null,
    `service_type_id` int(11) unsigned,
    `service_has_doctor` enum('1','0') not null default '0',
    `service_image` varchar(255),
    `service_is_active` enum('1','0') not null default '1',
    `service_is_rating` enum('1','0') not null default '0',
    `service_video_link` varchar(255),
    constraint foreign key(service_type_id) references service_types(service_type_id) ON DELETE SET NULL ON UPDATE CASCADE
)";

mysqli_query($connection,$sql);

// Countries Table
$sql = "create table if not exists `countries` (
    `country_id` int(11) unsigned not null primary key auto_increment,
    `country_name` varchar(30) not null,
    `country_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// States Table
$sql = "create table if not exists `states` (
    `state_id` int(11) unsigned not null primary key auto_increment,
    `state_name` varchar(30) not null,
    `country_id` int(11) unsigned not null,
    `state_is_active` enum('1','0') not null default '1',
    constraint fk_countries_country_id foreign key(country_id) references countries(country_id) ON DELETE CASCADE ON UPDATE CASCADE
)";

mysqli_query($connection,$sql);

// Cities Table
$sql = "create table if not exists `cities` (
    `city_id` int(11) unsigned not null primary key auto_increment,
    `city_name` varchar(30) not null,
    `state_id` int(11) unsigned not null,
    `city_is_active` enum('1','0') not null default '1',
    constraint fk_states_state_id foreign key(state_id) references states(state_id) ON DELETE CASCADE ON UPDATE CASCADE
)";

mysqli_query($connection,$sql);

// Departments Table
$sql = "create table if not exists `departments` (
    `department_id` integer(11) unsigned not null primary key auto_increment,
    `department_name` varchar(50) not null,
    `department_description` text not null,
    `department_image` varchar(255),
    `department_is_active` enum('1','0') not null default '0'
)";

mysqli_query($connection,$sql);

// Doctors Table
$sql = "create table if not exists `doctors` (
    `doctor_id` int(11) unsigned not null primary key auto_increment,
    `doctor_name` varchar(50) not null,
    `doctor_image` varchar(255),
    `doctor_phone` varchar(20),
    `doctor_address` varchar(150),
    `doctor_facebook` varchar(255),
    `doctor_twitter` varchar(255),
    `doctor_instgram` varchar(255),
    `department_id` int(11) unsigned,
    `doctor_is_show` enum('1','0') not null default '0',
    `doctor_is_active` enum('1','0') not null default '1',
    `doctor_is_rating` enum('1','0') not null default '0',
    `doctor_video_link` varchar(255),
    constraint fk_departmens_department_id foreign key(department_id) references departments(department_id) ON DELETE SET NULL ON UPDATE CASCADE
)";

mysqli_query($connection,$sql);

// Appointment Table
$sql = "create table if not exists `appointments` (
    `appointment_id` int(11) unsigned not null primary key auto_increment,
    `appointment_name` varchar(50) not null,
    `appointment_email` varchar(100) not null,
    `appointment_phone` varchar(20) not null,
    `appointment_date` varchar(255) not null,
    `appointment_date_birth` varchar(255) not null,
    `appointment_message` text,
    `appointment_is_confirmed` enum('1','0') default '0',
    `appointment_is_created_at` timestamp default current_timestamp,
    `service_id` int(11) unsigned,
    `doctor_id` int(11) unsigned,
    `country_id` int(11) unsigned,
    `state_id` int(11) unsigned,
    `city_id` int(11) unsigned,
    constraint  foreign key(doctor_id) references doctors(doctor_id) ON DELETE SET NULL ON UPDATE CASCADE,
    constraint  foreign key(service_id) references services(service_id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (`country_id`) REFERENCES `countries`(`country_id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (`state_id`) REFERENCES `states`(`state_id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (`city_id`) REFERENCES `cities`(`city_id`) ON DELETE SET NULL ON UPDATE CASCADE
    
)";

mysqli_query($connection,$sql);

// Servicing Hours Table
$sql = "create table if not exists `hours_servicings` (
    `hours_servicing_id` int(11) unsigned not null primary key auto_increment,
    `hours_servicing_day` varchar(50) not null,
    `hours_servicing_time` varchar(50) not null,
    `hours_servicing_is_active` enum('1','0') not null default '1'
)";

mysqli_query($connection,$sql);

// Features Table
$sql = "create table if not exists `features` (
    `feature_id` int(11) unsigned not null primary key auto_increment,
    `feature_name` varchar(50) not null,
    `feature_icon` varchar(50) not null,
    `feature_description` text not null,
    `feature_is_active` enum('1','0') not null default '0'
)";

mysqli_query($connection,$sql);

// Offers Table
$sql = "create table if not exists `offers` (
    `offer_id` int(11) unsigned not null primary key auto_increment,
    `offer_name` varchar(100) not null,
    `offer_description` text not null,
    `offer_image` varchar(255) not null,
    `offer_start_date` varchar(255) not null,
    `offer_end_date` varchar(255) not null,
    `offer_descound` int(3) default 0,
    `offer_is_active` enum('1','0') not null default '0'
)";

mysqli_query($connection,$sql);

// Feedbacks Table
$sql = "create table if not exists `feedbacks` (
    `feedback_id` int(11) unsigned not null primary key auto_increment,
    `feedback_name` varchar (50) not null,
    `feedback_content` text not null,
    `feedback_rate` enum('1','2','3','4','5') not null, 
    `service_id` int(11) unsigned,
    `doctor_id` int(11) unsigned,
    `feedback_is_show` enum('0','1') not null default '0',
    constraint  foreign key(service_id) references services(service_id) ON DELETE SET NULL ON UPDATE CASCADE,
    constraint  foreign key(doctor_id) references doctors(doctor_id) ON DELETE SET NULL ON UPDATE CASCADE

)";

mysqli_query($connection,$sql);

// Brand Table
$sql = "create table if not exists `brands` (
    `brand_id` integer unsigned not null primary key auto_increment,
    `brand_name` varchar(50) not null,
    `brand_description` varchar(255),
    `brand_image` varchar(255),
    `brand_is_active` enum('1','0') not null default '0'
)";

mysqli_query($connection,$sql);

// Brand Table
$sql = "create table if not exists `messages` (
    `message_id` int(11) unsigned not null primary key auto_increment,
    `message_name` varchar(30) not null,
    `message_email` varchar(255) not null,
    `message_subject` varchar(255),
    `message_content` text not null,
    `user_id` int(11) unsigned,
    constraint foreign key(user_id) references users(user_id) ON DELETE SET NULL ON UPDATE CASCADE
)";

mysqli_query($connection,$sql);

// Admins Table
$sql = "create table if not exists `admins` (
    `admin_id` int(11) unsigned not null primary key auto_increment,
    `admin_name` varchar(50) not null,
    `admin_email` varchar(100) not null,
    `admin_password` varchar(255) not null,
    `admin_image` varchar(255),
    `admin_type` enum('admin','super_admin') default('admin'),
    `admin_is_active` enum('0','1') default('0'),
    `admin_is_created_at` timestamp default current_timestamp
)";

mysqli_query($connection,$sql);

// Abouts Table
$sql = "create table if not exists `abouts` (
    `about_id` int(11) unsigned not null primary key auto_increment,
    `about_heading` varchar(255) not null,
    `about_slug` varchar(150) not null,
    `about_title` varchar(255) not null,
    `about_description` text not null,
    `about_image` varchar(255),
    `about_video_link` varchar(255),
    `about_is_active` enum('0','1') default '0'
)";

mysqli_query($connection,$sql);

// Questions Table
$sql = "create table if not exists `questions` (
    `question_id` int(11) unsigned not null primary key auto_increment,
    `question_content` varchar(255) not null,
    `question_is_active` enum('0','1') default('0')
)";

mysqli_query($connection,$sql);

// Answers Table
$sql = "create table if not exists `answers` (
    `answer_id` int(11) unsigned not null primary key auto_increment,
    `answer_content` text not null,
    `question_id` int(11) unsigned not null,
    `answer_is_active` enum('0','1') default('0'),
    CONSTRAINT FOREIGN KEY (`question_id`) REFERENCES `questions`(`question_id`) ON DELETE CASCADE ON UPDATE CASCADE
)";

mysqli_query($connection,$sql);

?>