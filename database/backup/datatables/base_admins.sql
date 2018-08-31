/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : o2orefectory

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2018-09-01 00:28:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for base_admins
-- ----------------------------
DROP TABLE IF EXISTS `base_admins`;
CREATE TABLE `base_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '角色状态 0 关闭 1 开启',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '管理员登录邮箱',
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理员登录密码',
  `role_id` int(10) unsigned NOT NULL COMMENT '用户角色',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理员token',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '管理员姓名',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理员手机号码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_admins_email_unique` (`email`),
  KEY `base_admins_role_id_foreign` (`role_id`),
  CONSTRAINT `base_admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `base_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for base_logs
-- ----------------------------
DROP TABLE IF EXISTS `base_logs`;
CREATE TABLE `base_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路由名称',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '提交参数',
  `admin_id` int(10) unsigned NOT NULL COMMENT '操作用户',
  `status_code` smallint(6) NOT NULL COMMENT 'http状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求方式',
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`),
  KEY `base_logs_admin_id_index` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for base_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `base_permission_role`;
CREATE TABLE `base_permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `base_permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `base_permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `base_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `base_permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `base_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for base_permissions
-- ----------------------------
DROP TABLE IF EXISTS `base_permissions`;
CREATE TABLE `base_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `islink` tinyint(4) NOT NULL DEFAULT '1',
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '255' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for base_roles
-- ----------------------------
DROP TABLE IF EXISTS `base_roles`;
CREATE TABLE `base_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色标识（用于程序）',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '角色状态 0 关闭 1 开启',
  `super` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否超级管理员 0 不是 1 是',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色介绍',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `notifiable_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '通知关联类型',
  `notifiable_id` bigint(20) unsigned NOT NULL COMMENT '通知外链关联ID',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '主体',
  `read_at` timestamp NULL DEFAULT NULL COMMENT '阅读时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifiable_type_id` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for seller_logs
-- ----------------------------
DROP TABLE IF EXISTS `seller_logs`;
CREATE TABLE `seller_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) unsigned NOT NULL COMMENT '店铺ID',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作说明',
  `admin_id` int(10) unsigned NOT NULL COMMENT '操作用户id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_logs_seller_id_index` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for seller_materials
-- ----------------------------
DROP TABLE IF EXISTS `seller_materials`;
CREATE TABLE `seller_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) unsigned NOT NULL COMMENT '店铺Id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店铺法人',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '资料是否齐全 0 不齐 , 1 齐全',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seller_certificates_seller_id_unique` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for sellers
-- ----------------------------
DROP TABLE IF EXISTS `sellers`;
CREATE TABLE `sellers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商店名称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '商店状态 1 正常  0关闭',
  `auditing_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审核状态 0 待审核 1 已审核 2 审核失败',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
