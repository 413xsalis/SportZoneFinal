-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2025 a las 18:28:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sportzone1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `horario_id` bigint(20) UNSIGNED NOT NULL,
  `subgrupo_id` int(10) UNSIGNED NOT NULL,
  `actividad` varchar(50) NOT NULL,
  `estado` enum('activo','pendiente','cancelado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `horario_id`, `subgrupo_id`, `actividad`, `estado`, `created_at`, `updated_at`) VALUES
(35, 15, 1, 'estiramientos', 'activo', '2025-08-17 22:32:13', '2025-08-17 22:32:13'),
(36, 14, 2, 'primera clase', 'pendiente', '2025-08-17 22:32:26', '2025-08-17 22:32:26'),
(37, 13, 3, 'tercera clase', 'cancelado', '2025-08-17 22:32:39', '2025-08-17 22:32:39'),
(38, 15, 1, 'primera clase', 'activo', '2025-08-17 22:39:37', '2025-08-17 22:39:37'),
(39, 13, 2, 'segunda clase', 'cancelado', '2025-08-17 22:41:32', '2025-08-17 22:41:32'),
(40, 14, 3, 'tercera clase', 'pendiente', '2025-08-17 22:42:31', '2025-08-17 22:42:31'),
(41, 11, 3, 'segunda clase', 'activo', '2025-08-17 22:45:38', '2025-08-17 22:45:38'),
(42, 15, 1, 'primera clase', 'activo', '2025-08-17 22:49:11', '2025-08-17 22:49:11'),
(43, 15, 1, 'primera clase', 'activo', '2025-08-17 22:50:51', '2025-08-17 22:50:51'),
(44, 11, 1, 'primera clase', 'activo', '2025-08-17 22:53:04', '2025-08-17 22:53:04'),
(45, 15, 2, 'tercera clase', 'cancelado', '2025-08-17 23:00:14', '2025-08-17 23:00:14'),
(46, 11, 3, 'estiramientos', 'pendiente', '2025-08-17 23:01:37', '2025-08-17 23:01:37'),
(47, 11, 2, 'estiramientos', 'cancelado', '2025-08-17 23:07:02', '2025-08-17 23:07:02'),
(48, 11, 2, 'segunda clase', 'cancelado', '2025-08-17 23:14:30', '2025-08-17 23:14:30'),
(49, 11, 2, 'segunda clase', 'cancelado', '2025-08-17 23:15:06', '2025-08-17 23:15:06'),
(50, 11, 2, 'segunda clase', 'cancelado', '2025-08-17 23:15:09', '2025-08-17 23:15:09'),
(51, 11, 2, 'segunda clase', 'cancelado', '2025-08-17 23:18:23', '2025-08-17 23:18:23'),
(52, 15, 1, 'primera clase', 'pendiente', '2025-08-17 23:18:53', '2025-08-17 23:18:53'),
(53, 14, 3, 'tercera clase', 'activo', '2025-08-17 23:22:33', '2025-08-17 23:22:33'),
(54, 15, 2, 'estiramientos', 'cancelado', '2025-08-17 23:25:21', '2025-08-17 23:25:21'),
(55, 15, 1, 'primera clase', 'activo', '2025-08-17 23:33:26', '2025-08-17 23:33:26'),
(56, 11, 2, 'segunda clase', 'pendiente', '2025-08-17 23:33:35', '2025-08-17 23:33:35'),
(57, 13, 3, 'tercera clase', 'cancelado', '2025-08-17 23:33:48', '2025-08-17 23:33:48'),
(58, 13, 3, 'primera clase', 'activo', '2025-08-17 23:38:29', '2025-08-17 23:38:29'),
(59, 14, 2, 'segunda clase', 'pendiente', '2025-08-17 23:38:44', '2025-08-17 23:38:44'),
(60, 15, 1, 'tercera clase', 'cancelado', '2025-08-17 23:38:54', '2025-08-17 23:38:54'),
(61, 15, 1, 'estiramientos', 'pendiente', '2025-08-17 23:47:54', '2025-08-17 23:47:54'),
(62, 15, 2, 'estiramientos', 'pendiente', '2025-08-24 07:15:45', '2025-08-24 07:15:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_documento` int(12) NOT NULL,
  `subgrupo_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('presente','ausente','justificado') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `estudiante_documento`, `subgrupo_id`, `fecha`, `estado`, `created_at`, `updated_at`) VALUES
(1, 300400500, 3, '2025-07-30', 'ausente', NULL, NULL),
(2, 1073599534, 1, '2025-07-30', 'presente', NULL, NULL),
(3, 1073599534, 1, '2025-08-15', 'presente', NULL, NULL),
(4, 1073599534, 1, '2025-08-24', 'presente', NULL, NULL),
(5, 300400500, 3, '2025-08-24', 'ausente', NULL, NULL),
(6, 200300412, 2, '2025-08-24', 'justificado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `documento` int(11) NOT NULL,
  `nombre_1` varchar(255) NOT NULL,
  `nombre_2` varchar(255) DEFAULT NULL,
  `apellido_1` varchar(255) NOT NULL,
  `apellido_2` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `nombre_contacto` varchar(255) DEFAULT NULL,
  `telefono_contacto` varchar(255) DEFAULT NULL,
  `eps` varchar(255) DEFAULT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`documento`, `nombre_1`, `nombre_2`, `apellido_1`, `apellido_2`, `telefono`, `nombre_contacto`, `telefono_contacto`, `eps`, `grupo_id`, `created_at`, `updated_at`) VALUES
(1022962622, 'dieguito', 'juanes', 'morita', 'flores', '3104139818', 'juanito', '123456789', 'sura', 1, '2025-08-26 19:29:17', '2025-08-26 19:29:17'),
(1022962623, 'ricardiño', 'Ricardoe', 'morita', 'gutierrez', '3194138715', 'juanito', '3001002001', 'sura', 4, '2025-08-26 19:43:29', '2025-08-26 19:43:29'),
(1073599572, 'Rafaelito', 'Ricardoe', 'morita', 'qerqqrqw', '31748003993', 'juanito', '3001002001', 'compensar123', 2, '2025-08-26 19:50:27', '2025-08-26 19:50:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Infantil', NULL, NULL),
(2, 'Juvenil', NULL, NULL),
(3, 'Avanzado', NULL, NULL),
(4, 'Experto', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dia` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `dia`, `fecha`, `hora_inicio`, `hora_fin`, `instructor_id`, `grupo_id`, `created_at`, `updated_at`) VALUES
(1, 'lunes', '2025-08-26', '12:33:00', '15:36:00', 3, 2, '2025-08-26 09:33:07', '2025-08-26 09:33:07'),
(2, 'martes', '2025-09-02', '08:00:00', '10:10:00', 4, 4, '2025-08-26 18:45:20', '2025-08-26 18:45:20'),
(3, 'jueves', '2025-09-04', '11:45:00', '03:45:00', 6, 3, '2025-08-26 19:45:22', '2025-08-26 19:45:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_19_181702_create_products_table', 1),
(5, '2025_06_19_184223_create_estudiantes_table', 1),
(6, '2025_06_23_205251_create_grupos_table', 1),
(7, '2025_06_23_205802_create_horarios_table', 1),
(8, '2025_06_29_163749_add_timestamps_to_estudiantes_table', 1),
(9, '2025_06_30_202209_create_permission_tables', 1),
(10, '2025_07_17_172711_create_subgrupos_table', 1),
(11, '2025_08_15_023001_add_deleted_at_to_users_table--table=users', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `estudiante_documento` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `medio_pago` enum('efectivo','nequi','daviplata','transferencia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `concepto`, `tipo`, `valor`, `fecha_pago`, `estado`, `estudiante_documento`, `created_at`, `updated_at`, `medio_pago`) VALUES
(1, 'mes de septiembre', 'mensualidad', 400000.00, '2025-08-18', 'Pagado', 10000, '2025-08-18 19:34:25', '2025-08-23 21:01:50', 'transferencia'),
(10, 'pago mes septiembre', 'mensualidad', 230000.00, '2025-08-23', 'Pagado', 700700700, '2025-08-23 21:16:59', '2025-08-23 21:16:59', 'efectivo'),
(12, 'pago agosto', 'mensualidad', 210000.00, '2025-08-24', 'Pagado', 500600700, '2025-08-24 19:40:15', '2025-08-24 19:40:15', 'transferencia'),
(13, NULL, 'inscripción', 10000000.00, '2025-09-06', 'Pagado', 1073599572, '2025-08-26 18:52:38', '2025-08-26 18:52:38', 'nequi'),
(14, NULL, 'inscripción', 100000.00, '2025-08-28', 'Pagado', 1022962623, '2025-08-26 19:52:33', '2025-08-26 19:52:33', 'nequi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-08-26 09:12:17', '2025-08-26 09:12:17'),
(2, 'colaborador', 'web', '2025-08-26 09:12:27', '2025-08-26 09:12:27'),
(3, 'instructor', 'web', '2025-08-26 09:12:36', '2025-08-26 09:12:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('siA7Lm5DOEhxRYBWzWB0yV4EsNfPodoZxTFg5uWA', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0 (Edition std-1)', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieEJzaWVNYnJrcWw3ZmNEREtnWjRJZVdWOUM1aUNOMnh4cjRnZGRsYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbnN0L2hvcmFyaW8iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1NjIyNDU4MTt9fQ==', 1756225676);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subgrupos`
--

CREATE TABLE `subgrupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `subgrupos`
--

INSERT INTO `subgrupos` (`id`, `nombre`, `grupo_id`, `created_at`, `updated_at`) VALUES
(1, 'Grupo A', 1, NULL, NULL),
(2, 'Grupo B', 2, NULL, NULL),
(3, 'Grupo B', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `eps` varchar(255) DEFAULT NULL,
  `documento_identidad` varchar(255) DEFAULT NULL,
  `foto_documento` varchar(255) DEFAULT NULL,
  `direccion_hogar` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `logo_personalizado` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `eps`, `documento_identidad`, `foto_documento`, `direccion_hogar`, `fecha_nacimiento`, `telefono`, `foto_perfil`, `logo_personalizado`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'alex', 'hola@email.com', NULL, '$2y$12$oj.rwyaQ2sjHYm1v9.mvYufa0HLuwF.RLJebObuCGQkW6nTAvEkNi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 09:16:13', '2025-08-26 09:16:13', NULL),
(2, 'ricardo pinzon', 'richi@email.com', NULL, '$2y$12$KzIUdKlX9yNONUhbDx6IVuOvR/fXeyVtr3HZimh2tyGw9/TJmJZ/K', 'Coomeva', '1234567801', 'documentos/aRn0BiYxh8RCTDeMo4kDQv6MzP1OjGNmoKkQzyD4.png', 'adfasfa', '2000-06-21', '31748003993', 'logos/nJhhA7q1qC16VLsDQIm3dCIpRML39bMD2nEZiYZt.png', 'logos/nJhhA7q1qC16VLsDQIm3dCIpRML39bMD2nEZiYZt.png', NULL, '2025-08-26 09:16:59', '2025-08-26 17:36:26', NULL),
(3, 'diego mora', 'diego@email.com', NULL, '$2y$12$kwv8W9iNQfKLnn5tTH2UPOAbevdtaGmZw5uCT8PjqM1CeUv.G9fDW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 09:17:36', '2025-08-26 09:17:36', NULL),
(4, 'leidi', 'leidi@email.com', NULL, '$2y$12$RxSYsy2YUXU87bz15FcY3eHU1u9UtDNb.aQPn6LqYmnZiRk2v2t5y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 09:18:02', '2025-08-26 09:18:02', NULL),
(5, 'alex1', 'alex@email.com', NULL, '$2y$12$ZPfOyfWsoVDwyj9AQxZgku1aYZQ2vf.rDxgS5U2r2oBclUm3XCxMi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 09:18:38', '2025-08-26 09:18:38', NULL),
(6, 'sebastian peralta', 'sebastian@email.com', NULL, '$2y$12$Cr7KUSLh.38xS9yuVI3Cu.lTHRPPOoJUf/AkgZoqHnLjVB7h0s/EC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 18:46:31', '2025-08-26 18:46:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividades_horario_id_foreign` (`horario_id`),
  ADD KEY `actividades_subgrupo_id_foreign` (`subgrupo_id`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asistencias_estudiante_documento_fecha_unique` (`estudiante_documento`,`fecha`),
  ADD KEY `asistencias_subgrupo_id_foreign` (`subgrupo_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_instructor_id_foreign` (`instructor_id`),
  ADD KEY `horarios_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pagos_estudiante_documento_tipo_unique` (`estudiante_documento`,`tipo`),
  ADD UNIQUE KEY `unique_pago_estudiante_tipo` (`estudiante_documento`,`tipo`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `subgrupos`
--
ALTER TABLE `subgrupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subgrupos_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subgrupos`
--
ALTER TABLE `subgrupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `horarios_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subgrupos`
--
ALTER TABLE `subgrupos`
  ADD CONSTRAINT `subgrupos_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
