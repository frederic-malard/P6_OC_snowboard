-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 12 mai 2022 à 12:24
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `P6_OC_snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `figure_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `signale` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `auteur_id`, `figure_id`, `date_creation`, `contenu`, `signale`) VALUES
(1, 1, 1, '2020-01-04 14:35:51', 'Fugiat aspernatur mollitia quibusdam aliquam nesciunt dignissimos. Suscipit laudantium nihil suscipit quo est non repudiandae. Similique quo laborum omnis deserunt.', NULL),
(2, 1, 10, '2020-01-04 14:35:51', 'Ipsum fugiat voluptatem dolores nobis. Aut qui ad dolores placeat quibusdam minus. Optio cupiditate aperiam quasi nulla sit dolor.', NULL),
(3, 1, 21, '2020-01-04 14:35:51', 'Sequi dolore iure aperiam soluta. Dolor necessitatibus aut quaerat ut qui doloribus et. Sed nihil doloremque omnis nostrum.', NULL),
(4, 1, 22, '2020-01-04 14:35:51', 'Autem eos officiis dolor dolorem aut. Natus laudantium ut laudantium. Est beatae earum ea autem non temporibus.', 1),
(5, 1, 24, '2020-01-04 14:35:51', 'Repellat nam molestiae similique explicabo eveniet. Qui aut quis blanditiis. Pariatur sint tenetur hic recusandae.', NULL),
(6, 2, 3, '2020-01-04 14:35:51', 'Libero magnam maxime quis impedit. Architecto atque qui est veritatis aut aliquid dolor. Omnis impedit debitis aut inventore architecto dicta fuga.', NULL),
(7, 2, 8, '2020-01-04 14:35:51', 'Quidem architecto laudantium tempore enim. Accusamus consequatur delectus non. Qui voluptatem ut ea dolor ratione.', NULL),
(8, 2, 12, '2020-01-04 14:35:51', 'Minus tempore porro ipsam quidem nihil. Architecto omnis sint ad accusantium cumque atque. Omnis sed in natus.', 1),
(9, 2, 13, '2020-01-04 14:35:51', 'Nihil vel beatae ut voluptas assumenda magnam dolorum rerum. Voluptatem fugiat repudiandae nesciunt consectetur corporis voluptates. Maiores ut ea harum ab molestiae omnis dolor aut.', NULL),
(10, 2, 17, '2020-01-04 14:35:51', 'Fugit veritatis aut dolorem omnis repellat sequi. Eos aut voluptas at quidem assumenda. Qui doloribus incidunt mollitia alias.', 1),
(11, 2, 19, '2020-01-04 14:35:51', 'Libero eum et blanditiis perspiciatis. Hic soluta nihil iusto aut iste nihil. Et non voluptatibus voluptatem nihil.', NULL),
(12, 2, 24, '2020-01-04 14:35:51', 'Tempore odit commodi accusamus asperiores odio et ut. Quia modi deserunt eius voluptatem. Qui cum eveniet sed explicabo et voluptatem sunt.', NULL),
(13, 3, 1, '2020-01-04 14:35:51', 'Qui tenetur tempore dolorem. Velit corporis vero commodi dolorem ratione. Porro enim ut magni et.', 1),
(14, 3, 4, '2020-01-04 14:35:51', 'Minus totam quo recusandae velit nostrum et. Impedit provident quo quia aliquid. Qui excepturi nihil quia fugiat exercitationem magni.', NULL),
(15, 3, 8, '2020-01-04 14:35:51', 'Nesciunt repudiandae quibusdam sed quo. Voluptatem facilis asperiores error esse sint laudantium qui. Earum quas aut laborum dolor.', NULL),
(16, 3, 9, '2020-01-04 14:35:51', 'Error deserunt et nisi. Aut et laudantium necessitatibus rerum quod eveniet corrupti. Non et accusantium harum et.', NULL),
(17, 3, 11, '2020-01-04 14:35:51', 'Qui omnis odio sit. Expedita officia nihil et officia. Est odit minima aut qui aspernatur est eos.', 1),
(18, 3, 13, '2020-01-04 14:35:51', 'Dignissimos doloremque ipsam ipsum minus corrupti corporis. Velit ex provident quo et aut. Sunt omnis et veritatis a.', NULL),
(19, 3, 15, '2020-01-04 14:35:51', 'Aut corporis odio ipsam eligendi. Iure consequatur eligendi repellendus ipsa sint. Sit quam aliquam assumenda repellendus error.', NULL),
(20, 3, 17, '2020-01-04 14:35:51', 'Odit deserunt accusamus et. Quo tempore quisquam qui minus. A ex sint recusandae.', NULL),
(21, 3, 25, '2020-01-04 14:35:51', 'Ea omnis expedita nobis eum ea. Minus quia asperiores nihil hic. Animi voluptatibus voluptatem est.', NULL),
(22, 4, 2, '2020-01-04 14:35:51', 'Ut et et distinctio deserunt non consequatur. Facere dolorem aliquid omnis omnis quia. Neque enim voluptate magni dolore.', NULL),
(23, 4, 6, '2020-01-04 14:35:51', 'Iste repellendus laboriosam a dolores qui itaque. Iure et distinctio veritatis voluptatem. Perspiciatis beatae nihil dolores dolorem.', NULL),
(24, 4, 10, '2020-01-04 14:35:51', 'Distinctio hic voluptatem ipsam est quos beatae sit id. Occaecati enim quia odit minus vero itaque aut. Perspiciatis et rerum rerum quisquam.', NULL),
(25, 4, 17, '2020-01-04 14:35:51', 'Corporis aut consequuntur sit quasi. Aut necessitatibus vel possimus animi assumenda voluptas necessitatibus. Tenetur voluptates recusandae eius doloribus et aliquid.', NULL),
(26, 4, 18, '2020-01-04 14:35:51', 'Ut ea dolorem rerum. Quam minima laborum sit nihil. Consequatur reiciendis animi explicabo dolore perspiciatis soluta sunt.', NULL),
(27, 4, 24, '2020-01-04 14:35:51', 'Animi iste aliquid et beatae nisi. Blanditiis porro deleniti soluta esse molestiae. Et et voluptatum reprehenderit culpa earum impedit fuga.', 1),
(28, 5, 3, '2020-01-04 14:35:51', 'Nam laboriosam minus ad animi. Est eligendi necessitatibus ea vel quo perferendis. Maxime quisquam accusantium ut enim.', NULL),
(29, 5, 6, '2020-01-04 14:35:51', 'Fuga eaque facere libero minima nulla dolores ullam id. Eaque numquam debitis sequi perspiciatis rerum asperiores. Et consequatur soluta ratione ducimus pariatur.', 1),
(30, 5, 9, '2020-01-04 14:35:51', 'Qui voluptas maiores veniam porro iure. Qui vitae officiis sed voluptate quibusdam quod. Aut repudiandae voluptate itaque perspiciatis quia.', NULL),
(31, 5, 12, '2020-01-04 14:35:51', 'Et non laboriosam et deserunt sit ipsum architecto. Cumque pariatur cumque laudantium suscipit magnam sint officiis quia. Quaerat consequuntur ut est et et aliquid rerum.', 1),
(32, 5, 15, '2020-01-04 14:35:51', 'Sit sunt expedita eos odio. Dolorum quo vero unde minus. Ut soluta occaecati est quod omnis non vitae cupiditate.', NULL),
(33, 5, 16, '2020-01-04 14:35:51', 'Dolor amet in autem. Rerum reiciendis vel odit sit. Sequi voluptatum sapiente enim minima.', 1),
(34, 5, 19, '2020-01-04 14:35:51', 'Nostrum quasi qui facere blanditiis. Iusto sed qui repellat dignissimos velit. Qui labore et est doloribus aut beatae quibusdam.', NULL),
(35, 5, 21, '2020-01-04 14:35:51', 'Excepturi est perspiciatis rerum alias asperiores assumenda. Atque reprehenderit quibusdam omnis minus eveniet quas libero. Amet eos itaque omnis possimus laborum eligendi.', NULL),
(36, 5, 24, '2020-01-04 14:35:51', 'Voluptatum ipsam est est dolorum nihil. Non quas unde nostrum ut deserunt soluta quidem. Amet delectus ipsam dignissimos qui natus dolorem est.', NULL),
(37, 5, 25, '2020-01-04 14:35:51', 'Et enim non magnam quia non. Est quod nisi ipsam rerum. Itaque occaecati sunt voluptatem et asperiores eveniet.', NULL),
(38, 6, 6, '2020-01-04 14:35:51', 'Eveniet fugiat non accusamus tenetur cumque perferendis rem. Temporibus facere qui nisi sit qui in sit. Nam illo error amet incidunt quaerat illum eligendi.', NULL),
(39, 6, 10, '2020-01-04 14:35:51', 'Exercitationem et et modi corporis ipsa. Unde vero laudantium architecto exercitationem. Eius ut aut aliquid nemo praesentium explicabo voluptates.', NULL),
(40, 6, 18, '2020-01-04 14:35:51', 'Voluptatem in autem quis est sit. Totam nesciunt hic recusandae et. Sunt voluptatibus et omnis corporis.', NULL),
(41, 6, 21, '2020-01-04 14:35:51', 'Voluptatibus debitis aliquid non placeat modi quos debitis incidunt. Blanditiis consequatur vero ullam mollitia et ea molestiae. Saepe aut blanditiis placeat aut.', NULL),
(42, 6, 22, '2020-01-04 14:35:51', 'Quis sit unde molestias et quidem. Voluptas est voluptatem dolor iure repellat dolorum. Molestias quaerat voluptatem totam eos.', NULL),
(43, 7, 8, '2020-01-04 14:35:51', 'Laboriosam ut vel nesciunt velit est pariatur. Aut repellendus doloribus quisquam vel velit aut quia labore. Ea officiis vel sunt.', NULL),
(44, 7, 9, '2020-01-04 14:35:51', 'Consequatur molestiae saepe optio occaecati. Nisi officiis iusto quas non. Repellendus consequatur quo adipisci quasi numquam aperiam voluptate et.', 1),
(45, 7, 13, '2020-01-04 14:35:51', 'Laudantium facere et odio exercitationem omnis quis et. Laboriosam facilis quia itaque aliquid incidunt natus nesciunt. Aliquam voluptatem in officia voluptatem.', NULL),
(46, 7, 14, '2020-01-04 14:35:51', 'Iure non ut animi mollitia ipsam non. Consequuntur soluta pariatur ea quaerat. Molestiae id voluptates quo quia et.', NULL),
(47, 7, 17, '2020-01-04 14:35:51', 'Dolorum nisi officiis deserunt dolorem inventore qui dolorem. Eos ullam nam magnam. Doloribus molestiae optio quia dolor.', NULL),
(48, 7, 19, '2020-01-04 14:35:51', 'Asperiores perferendis enim perferendis porro enim aliquam eaque quia. Consectetur a et quae sequi. Saepe molestias voluptatem repellat et aut corporis.', 1),
(49, 7, 25, '2020-01-04 14:35:51', 'Sit at nostrum tenetur et repellat explicabo doloremque. Deleniti vel illo delectus iure eligendi quos. Quia voluptates rem porro omnis.', NULL),
(50, 8, 5, '2020-01-04 14:35:51', 'Explicabo occaecati eos veniam sapiente quo ea deleniti. Et ut sequi velit doloribus. Odit deleniti non quia repellat pariatur.', NULL),
(51, 8, 10, '2020-01-04 14:35:51', 'Facere recusandae rem consequatur ut. Blanditiis eaque quae sequi optio rerum quo. Non in non enim voluptatibus.', 1),
(52, 8, 23, '2020-01-04 14:35:51', 'Voluptatem nemo assumenda mollitia quae vero et ratione quasi. Eveniet voluptatum laboriosam distinctio quidem nulla veniam. Tempore fugit sit nam ipsam placeat distinctio quam.', NULL),
(53, 2, 2, '2020-01-08 15:53:29', 'fvzf', 1),
(54, 2, 2, '2020-01-08 15:53:37', 'tzeghtr', NULL),
(55, 2, 2, '2020-01-08 15:53:45', 'opjgzp', NULL),
(56, 2, 2, '2020-01-08 15:53:51', 'opzjrpfg', NULL),
(57, 2, 2, '2020-01-08 15:54:00', 'zpojrgpezjg', 1),
(58, 2, 2, '2020-01-08 15:54:08', 'zoerpzergjkp', NULL),
(59, 2, 2, '2020-01-08 15:54:14', 'epjgepzogjze', NULL),
(60, 2, 2, '2020-01-08 15:54:21', 'poezgjpozjg', NULL),
(71, 2, 2, '2020-01-08 16:36:08', 'hoih', 1),
(72, 2, 2, '2020-01-08 16:36:18', 'johoho', 1),
(73, 2, 2, '2020-01-10 20:08:03', 'test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `difficulte`
--

CREATE TABLE `difficulte` (
  `id` int(11) NOT NULL,
  `notant_id` int(11) NOT NULL,
  `figure_id` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `difficulte`
--

INSERT INTO `difficulte` (`id`, `notant_id`, `figure_id`, `note`) VALUES
(1, 1, 2, 1),
(2, 1, 4, 9),
(3, 1, 6, 8),
(4, 2, 11, 5),
(5, 2, 12, 6),
(6, 2, 14, 3),
(7, 2, 20, 8),
(8, 2, 23, 5),
(9, 3, 24, 1),
(10, 4, 7, 8),
(11, 4, 10, 2),
(12, 4, 17, 8),
(13, 4, 18, 3),
(14, 4, 25, 4),
(15, 5, 9, 10),
(16, 5, 25, 4),
(17, 6, 5, 7),
(18, 6, 6, 3),
(19, 6, 11, 10),
(20, 6, 12, 3),
(21, 6, 20, 1),
(22, 6, 24, 2),
(23, 7, 1, 5),
(24, 7, 2, 1),
(25, 7, 22, 7),
(26, 8, 4, 3),
(27, 8, 21, 6),
(28, 8, 25, 4),
(29, 10, 26, 9),
(30, 10, 6, 5),
(31, 10, 9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `figure`
--

CREATE TABLE `figure` (
  `id` int(11) NOT NULL,
  `editeur_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `figure`
--

INSERT INTO `figure` (`id`, `editeur_id`, `groupe_id`, `nom`, `description`, `slug`, `date_creation`, `date_modification`) VALUES
(1, 3, 1, 'regular', 'Détermine la position sur la planche. Un rider regular aura le pied gauche devant.', 'regular', '2019-06-04 13:29:54', NULL),
(2, 5, 1, 'goofy', 'Détermine la position sur la planche. Un rider goofy aura le pied droit devant.', 'goofy', '2019-01-06 00:23:09', NULL),
(3, 5, 2, 'mute', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', 'mute', '2019-06-25 08:07:54', NULL),
(4, 6, 2, 'sad', 'Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant. Aussi appelé \"melancholie\" ou \"style week\"', 'sad', '2019-07-22 15:38:31', NULL),
(5, 3, 2, 'indy', 'Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.', 'indy', '2019-03-19 02:15:52', NULL),
(6, 2, 2, 'stalefish', 'Saisie de la carre backside de la planche entre les deux pieds avec la main arrière.', 'stalefish', '2019-12-01 15:13:04', NULL),
(7, 2, 2, 'tail', 'Saisie de la partie arrière de la planche, avec la main arrière.', 'tail', '2019-08-02 06:57:35', NULL),
(8, 3, 2, 'nose', 'Saisie de la partie avant de la planche, avec la main avant.', 'nose', '2019-03-28 12:36:12', NULL),
(9, 8, 2, 'japan', 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside. Aussi appelé \"japan air\".', 'japan', '2019-01-30 03:38:56', NULL),
(10, 2, 2, 'seatbelt', 'Saisie du carre frontside à l\'arrière avec la main avant.', 'seatbelt', '2019-08-20 08:19:10', NULL),
(11, 2, 2, 'truckdriver', 'Saisie du carre frontside à l\'arrière avec la main avant.', 'truckdriver', '2019-12-10 12:18:58', NULL),
(12, 7, 3, '180', 'Un 180 désigne un demi-tour, soit 180 degrés d\'angle.', '180', '2019-10-26 01:26:56', NULL),
(13, 1, 3, '360', '360, trois six pour un tour complet.', '360', '2019-07-10 18:39:15', NULL),
(14, 5, 3, '540', '540, cinq quatre pour un tour et demi.', '540', '2019-07-17 12:16:01', NULL),
(15, 2, 3, '720', '720, sept deux pour deux tours complets.', '720', '2019-02-11 03:47:04', NULL),
(16, 3, 3, '900', '900 pour deux tours et demi.', '900', '2019-08-24 21:48:16', NULL),
(17, 2, 3, '1080', '1080 ou big foot pour trois tours.', '1080', '2019-12-02 22:27:32', NULL),
(18, 3, 4, 'frontflip', 'Rotations en avant.', 'frontflip', '2019-09-07 00:51:12', NULL),
(19, 5, 4, 'backflip', 'Rotations en arrière.', 'backflip', '2019-10-02 22:04:15', NULL),
(20, 2, 5, 'cork540', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Le cork 540 est un 540 combiné avec un backflip.', 'cork540', '2019-08-03 11:19:57', NULL),
(21, 1, 6, 'slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.', 'slide', '2019-09-22 10:19:49', NULL),
(22, 2, 6, 'nose slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. Un nose slide est un slide fait sur l\'avant de la planche.', 'nose-slide', '2019-05-29 12:30:41', NULL),
(23, 4, 6, 'tail slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. Un tail slide est un slide fait sur l\'arrière de la planche.', 'tail-slide', '2019-09-20 22:01:15', NULL),
(24, 1, 7, 'one foot trick', 'Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n\'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.', 'one-foot-trick', '2019-05-04 04:28:08', NULL),
(25, 2, 8, 'rocket air', 'Attrapez l\'avant de la planche et mettez la planche a la verticale.', 'rocket-air', '2019-10-28 15:38:31', NULL),
(26, 10, 3, '1260', 'trois tours et demi sur sois-même.', '1260', '2022-05-12 08:34:51', '2022-05-12 08:36:05');

-- --------------------------------------------------------

--
-- Structure de la table `figure_figure`
--

CREATE TABLE `figure_figure` (
  `figure_source` int(11) NOT NULL,
  `figure_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `figure_figure`
--

INSERT INTO `figure_figure` (`figure_source`, `figure_target`) VALUES
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 14),
(20, 19),
(21, 1),
(21, 2),
(22, 21),
(23, 21),
(25, 1),
(25, 2),
(26, 17);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `slug`) VALUES
(1, 'ride', 'ride'),
(2, 'grab', 'grab'),
(3, 'rotation', 'rotation'),
(4, 'flip', 'flip'),
(5, 'rotation désaxée', 'rotation-desaxee'),
(6, 'slide', 'slide'),
(7, 'one foot trick', 'one-foot-trick'),
(8, 'old school', 'old-school');

-- --------------------------------------------------------

--
-- Structure de la table `illustration`
--

CREATE TABLE `illustration` (
  `id` int(11) NOT NULL,
  `figure_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `illustration`
--

INSERT INTO `illustration` (`id`, `figure_id`, `url`, `alt`) VALUES
(1, 1, '/illustrations/regular-1.jpg', 'photo regular-1.jpg'),
(2, 1, '/illustrations/regular-2.jpg', 'photo regular-2.jpg'),
(3, 1, '/illustrations/regular-goofy-1.jpg', 'photo regular-goofy-1.jpg'),
(4, 1, '/illustrations/regular-goofy-2.jpg', 'photo regular-goofy-2.jpg'),
(5, 1, '/illustrations/regular-goofy-3.jpg', 'photo regular-goofy-3.jpg'),
(6, 1, '/illustrations/regular-goofy-4.jpg', 'photo regular-goofy-4.jpg'),
(7, 2, '/illustrations/goofy-1.jpg', 'photo goofy-1.jpg'),
(8, 2, '/illustrations/regular-goofy-1.jpg', 'photo regular-goofy-1.jpg'),
(9, 2, '/illustrations/regular-goofy-2.jpg', 'photo regular-goofy-2.jpg'),
(10, 2, '/illustrations/regular-goofy-3.jpg', 'photo regular-goofy-3.jpg'),
(11, 2, '/illustrations/regular-goofy-4.jpg', 'photo regular-goofy-4.jpg'),
(12, 3, '/illustrations/mute-grab-1.png', 'photo mute-grab-1.png'),
(13, 3, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(14, 3, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(15, 3, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(16, 4, '/illustrations/sad-1.jpg', 'photo sad-1.jpg'),
(17, 5, '/illustrations/indy-1.jpg', 'photo indy-1.jpg'),
(18, 5, '/illustrations/indy-2.jpg', 'photo indy-2.jpg'),
(19, 5, '/illustrations/indy-3.jpg', 'photo indy-3.jpg'),
(20, 5, '/illustrations/indy-4.jpg', 'photo indy-4.jpg'),
(21, 5, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(22, 5, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(23, 5, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(24, 6, '/illustrations/stalefish-1.jpg', 'photo stalefish-1.jpg'),
(25, 6, '/illustrations/stalefish-2.jpg', 'photo stalefish-2.jpg'),
(26, 6, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(27, 6, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(28, 6, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(29, 7, '/illustrations/tail-1.jpg', 'photo tail-1.jpg'),
(30, 7, '/illustrations/tail-2.jpg', 'photo tail-2.jpg'),
(31, 7, '/illustrations/tail-3.jpg', 'photo tail-3.jpg'),
(32, 7, '/illustrations/tail-4.jpg', 'photo tail-4.jpg'),
(33, 7, '/illustrations/tail-5.jpg', 'photo tail-5.jpg'),
(34, 7, '/illustrations/tail-6.jpg', 'photo tail-6.jpg'),
(35, 7, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(36, 7, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(37, 7, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(38, 8, '/illustrations/nose-1.jpg', 'photo nose-1.jpg'),
(39, 8, '/illustrations/nose-2.jpg', 'photo nose-2.jpg'),
(40, 8, '/illustrations/nose-3.jpg', 'photo nose-3.jpg'),
(41, 8, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(42, 8, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(43, 8, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(44, 9, '/illustrations/japan-1.jpg', 'photo japan-1.jpg'),
(45, 9, '/illustrations/japan-2.jpg', 'photo japan-2.jpg'),
(46, 9, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(47, 9, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(48, 9, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(49, 10, '/illustrations/seatbelt-1.jpg', 'photo seatbelt-1.jpg'),
(50, 10, '/illustrations/seatbelt-2.jpg', 'photo seatbelt-2.jpg'),
(51, 10, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(52, 10, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(53, 10, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(54, 11, '/illustrations/truck-driver-1.jpg', 'photo truck-driver-1.jpg'),
(55, 11, '/illustrations/grabs-1.jpg', 'photo grabs-1.jpg'),
(56, 11, '/illustrations/grabs-2.png', 'photo grabs-2.png'),
(57, 11, '/illustrations/grabs-3.jpg', 'photo grabs-3.jpg'),
(58, 18, '/illustrations/front-flip-1.jpg', 'photo front-flip-1.jpg'),
(59, 18, '/illustrations/front-flip-2.jpg', 'photo front-flip-2.jpg'),
(60, 18, '/illustrations/front-flip-3.jpg', 'photo front-flip-3.jpg'),
(61, 18, '/illustrations/front-flip-4.jpg', 'photo front-flip-4.jpg'),
(62, 19, '/illustrations/back-flip-1.jpg', 'photo back-flip-1.jpg'),
(63, 19, '/illustrations/back-flip-2.jpg', 'photo back-flip-2.jpg'),
(64, 19, '/illustrations/back-flip-3.jpg', 'photo back-flip-3.jpg'),
(65, 20, '/illustrations/cork540-1.jpg', 'photo cork540-1.jpg'),
(66, 20, '/illustrations/cork540-2.jpg', 'photo cork540-2.jpg'),
(67, 21, '/illustrations/slide-1.jpg', 'photo slide-1.jpg'),
(68, 21, '/illustrations/slide-2.jpg', 'photo slide-2.jpg'),
(69, 22, '/illustrations/nose-slide-1.jpg', 'photo nose-slide-1.jpg'),
(70, 23, '/illustrations/tail-slide-1.jpg', 'photo tail-slide-1.jpg'),
(71, 24, '/illustrations/one-foot-trick-1.jpg', 'photo one-foot-trick-1.jpg'),
(72, 24, '/illustrations/one-foot-trick-2.jpg', 'photo one-foot-trick-2.jpg'),
(73, 24, '/illustrations/one-foot-trick-3.jpg', 'photo one-foot-trick-3.jpg'),
(74, 25, '/illustrations/rocket-air-1.jpg', 'photo rocket-air-1.jpg'),
(75, 25, '/illustrations/rocket-air-2.jpg', 'photo rocket-air-2.jpg'),
(76, 25, '/illustrations/rocket-air-3.jpg', 'photo rocket-air-3.jpg'),
(77, 26, '/illustrations/64929647.png', 'une illustration de la figure 1260');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200104133533', '2020-01-04 13:35:42');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_verifier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reinitialisation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `mot_de_passe`, `mail`, `role`, `avatar`, `slug`, `a_verifier`, `reinitialisation`) VALUES
(1, 'modo', '$2y$13$Cu03XLTueYAXV5BVrAaRTeLz0YkcbVFkxV0mHA1D6hQ4ll7MZBKmW', 'caufderhar@ernser.com', 'moderateur', '/avatars/1.png', 'modo', NULL, NULL),
(2, 'admin', '$2y$13$qZPGtuWLeC4iaSoGnejW.u/DOPMu8TCaYxpH4el68RUDPD/yEdsMu', 'zwalter@hotmail.com', 'administrateur', '/avatars/2.png', 'admin', NULL, '8c0c228a5ed0'),
(3, 'eos5849', '$2y$13$alUHg0hqYS1iuPnrfXj1lePEHzqA7LdhpXCaZkYQ3WkM7fWGlpZSS', 'joseph22@yahoo.com', 'utilisateur', '/avatars/3.png', 'eos5849', NULL, NULL),
(4, 'vel2535', '$2y$13$MV55zPL/7bxIhgDYu/DC/eYSkxmcgtWEgB5ndVfhxu9jkFqcnFkhS', 'fturcotte@yahoo.com', 'utilisateur', '/avatars/4.png', 'vel2535', NULL, NULL),
(5, 'et9989', '$2y$13$5uBmua3HezVzR7Srw2pxHOfMrFTttfNil3ewQW6VNJKMhzUDv3ikW', 'conor.boehm@yahoo.com', 'utilisateur', '/avatars/5.png', 'et9989', NULL, NULL),
(6, 'ut8869', '$2y$13$XMfgcpxB2VWu7eVBiPeU5eeEEItbN3VcHehbdFixNE1hFEi.AtgCa', 'zkoepp@graham.info', 'utilisateur', '/avatars/6.png', 'ut8869', NULL, NULL),
(7, 'aut6857', '$2y$13$sx4.XYYVDo9pRM.hNH2vQOOdFV9Qu2Jo4jh78M3V/PWWRhLj1AnjW', 'nikita.corwin@grady.com', 'utilisateur', '/avatars/7.png', 'aut6857', NULL, NULL),
(8, 'cumque7444', '$2y$13$K9ut.9SkxFnlTJi7Mo..DeUwU2ScNhl88KJJtsEv1RT.ah3Yo/uT.', 'zhills@hotmail.com', 'utilisateur', NULL, 'cumque7444', NULL, NULL),
(9, 'abcdef', '$argon2id$v=19$m=65536,t=4,p=1$DyVk2EsCp2KmtbdesYKOsA$p8ap7KvZ3SmFklrGGREpHONFLylANeUY5dpHwcdMm90', 'fred.malard@gmx.fr', 'utilisateur', NULL, 'abcdef', 'ecf2a9cc8b25', NULL),
(10, 'user_test', '$argon2id$v=19$m=65536,t=4,p=1$9aJqygwZ1NYjcwTba30/eg$OJlIWdJ+NnpHGbcUDJ5No3KZohukslsL53nqIJS67l0', 'fred.malard@gmx.fr', 'utilisateur', NULL, 'user-test', NULL, NULL),
(11, 'abcdefg', '$argon2id$v=19$m=65536,t=4,p=1$ySv2BHiHrtX9pYvWN1SwaQ$74IDTE/94wvpgbxYtv43v/oVGfco7ucAuSAC+wz+Iws', 'fred.malard@gmx.fr', 'utilisateur', NULL, 'abcdefg', 'c5fc7422bdf1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_figure`
--

CREATE TABLE `utilisateur_figure` (
  `utilisateur_id` int(11) NOT NULL,
  `figure_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur_figure`
--

INSERT INTO `utilisateur_figure` (`utilisateur_id`, `figure_id`) VALUES
(1, 6),
(1, 25),
(2, 4),
(2, 7),
(2, 10),
(2, 12),
(2, 17),
(2, 20),
(2, 25),
(3, 6),
(3, 24),
(4, 1),
(4, 6),
(4, 9),
(4, 11),
(5, 8),
(5, 16),
(5, 18),
(5, 21),
(6, 4),
(6, 8),
(6, 9),
(6, 13),
(6, 22),
(7, 5),
(7, 8),
(7, 14),
(7, 20),
(8, 5),
(8, 6),
(8, 13),
(10, 6),
(10, 9);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `figure_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `figure_id`, `url`, `alt`) VALUES
(1, 1, 'https://www.youtube.com/embed/u20epr7tSEU', 'video'),
(2, 2, 'https://www.youtube.com/embed/GcacU4p2W-o', 'video'),
(3, 3, 'https://www.youtube.com/embed/51sQRIK-TEI', 'video'),
(4, 3, 'https://www.youtube.com/embed/Opg5g4zsiGY', 'video'),
(5, 4, 'https://www.youtube.com/embed/KEdFwJ4SWq4', 'video'),
(6, 4, 'https://www.youtube.com/embed/CA5bURVJ5zk', 'video'),
(7, 5, 'https://www.youtube.com/embed/iKkhKekZNQ8', 'video'),
(8, 5, 'https://www.youtube.com/embed/6QsLhWzXGu0', 'video'),
(9, 5, 'https://www.youtube.com/embed/6yA3XqjTh_w', 'video'),
(10, 6, 'https://www.youtube.com/embed/f9FjhCt_w2U', 'video'),
(11, 7, 'https://www.youtube.com/embed/id8VKl9RVQw', 'video'),
(12, 7, 'https://www.youtube.com/embed/_Qq-YoXwNQY', 'video'),
(13, 8, 'https://www.youtube.com/embed/gZFWW4Vus-Q', 'video'),
(14, 8, 'https://www.youtube.com/embed/M-W7Pmo-YMY', 'video'),
(15, 9, 'https://www.youtube.com/embed/CzDjM7h_Fwo', 'video'),
(16, 9, 'https://www.youtube.com/embed/jH76540wSqU', 'video'),
(17, 10, 'https://www.youtube.com/embed/4vGEOYNGi_c', 'video'),
(18, 10, 'https://www.youtube.com/embed/eTx2uVcbLzM', 'video'),
(19, 12, 'https://www.youtube.com/embed/JMS2PGAFMcE', 'video'),
(20, 12, 'https://www.youtube.com/embed/GnYAlEt-s00', 'video'),
(21, 12, 'https://www.youtube.com/embed/ATMiAVTLsuc', 'video'),
(22, 13, 'https://www.youtube.com/embed/GS9MMT_bNn8', 'video'),
(23, 13, 'https://www.youtube.com/embed/hUddT6FGCws', 'video'),
(24, 13, 'https://www.youtube.com/embed/6gFsbU3GWF0', 'video'),
(25, 14, 'https://www.youtube.com/embed/_hJX9HrdkeA', 'video'),
(26, 14, 'https://www.youtube.com/embed/cdekJgZs9qY', 'video'),
(27, 14, 'https://www.youtube.com/embed/K0dx4qT4wrQ', 'video'),
(28, 15, 'https://www.youtube.com/embed/4JfBfQpG77o', 'video'),
(29, 15, 'https://www.youtube.com/embed/XkkUSEz3I00', 'video'),
(30, 15, 'https://www.youtube.com/embed/H0-apzROnqE', 'video'),
(31, 16, 'https://www.youtube.com/embed/g8QUV2Vl1Zw', 'video'),
(32, 16, 'https://www.youtube.com/embed/G7Hgj0i95Ag', 'video'),
(33, 16, 'https://www.youtube.com/embed/8ifvMImDkew', 'video'),
(34, 17, 'https://www.youtube.com/embed/VXb3IjPh3sI', 'video'),
(35, 17, 'https://www.youtube.com/embed/EsP0fzKi6Ac', 'video'),
(36, 18, 'https://www.youtube.com/embed/xhvqu2XBvI0', 'video'),
(37, 18, 'https://www.youtube.com/embed/eGJ8keB1-JM', 'video'),
(38, 18, 'https://www.youtube.com/embed/aTTkQ45DUfk', 'video'),
(39, 19, 'https://www.youtube.com/embed/SlhGVnFPTDE', 'video'),
(40, 19, 'https://www.youtube.com/embed/AMsWP9WJS_0', 'video'),
(41, 19, 'https://www.youtube.com/embed/arzLq-47QFA', 'video'),
(42, 20, 'https://www.youtube.com/embed/FMHiSF0rHF8', 'video'),
(43, 21, 'https://www.youtube.com/embed/WOgw5uBSLp0', 'video'),
(44, 21, 'https://www.youtube.com/embed/R3OG9rNDIcs', 'video'),
(45, 22, 'https://www.youtube.com/embed/oAK9mK7wWvw', 'video'),
(46, 23, 'https://www.youtube.com/embed/HRNXjMBakwM', 'video'),
(47, 23, 'https://www.youtube.com/embed/KqSi94FT7EE', 'video'),
(48, 24, 'https://www.youtube.com/embed/4IVdWdvsrVA', 'video'),
(49, 24, 'https://www.youtube.com/embed/d7dpo_G9npo', 'video'),
(50, 25, 'https://www.youtube.com/embed/4IVdWdvsrVA', 'video'),
(51, 25, 'https://www.youtube.com/embed/d7dpo_G9npo', 'video');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC60BB6FE6` (`auteur_id`),
  ADD KEY `IDX_67F068BC5C011B5` (`figure_id`);

--
-- Index pour la table `difficulte`
--
ALTER TABLE `difficulte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AF6A33A0FBB3368D` (`notant_id`),
  ADD KEY `IDX_AF6A33A05C011B5` (`figure_id`);

--
-- Index pour la table `figure`
--
ALTER TABLE `figure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2F57B37A3375BD21` (`editeur_id`),
  ADD KEY `IDX_2F57B37A7A45358C` (`groupe_id`);

--
-- Index pour la table `figure_figure`
--
ALTER TABLE `figure_figure`
  ADD PRIMARY KEY (`figure_source`,`figure_target`),
  ADD KEY `IDX_704016F49DDAFD` (`figure_source`),
  ADD KEY `IDX_704016F419788A72` (`figure_target`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `illustration`
--
ALTER TABLE `illustration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D67B9A425C011B5` (`figure_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur_figure`
--
ALTER TABLE `utilisateur_figure`
  ADD PRIMARY KEY (`utilisateur_id`,`figure_id`),
  ADD KEY `IDX_4EFA89F1FB88E14F` (`utilisateur_id`),
  ADD KEY `IDX_4EFA89F15C011B5` (`figure_id`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CC7DA2C5C011B5` (`figure_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `difficulte`
--
ALTER TABLE `difficulte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `figure`
--
ALTER TABLE `figure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `illustration`
--
ALTER TABLE `illustration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`),
  ADD CONSTRAINT `FK_67F068BC60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `difficulte`
--
ALTER TABLE `difficulte`
  ADD CONSTRAINT `FK_AF6A33A05C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`),
  ADD CONSTRAINT `FK_AF6A33A0FBB3368D` FOREIGN KEY (`notant_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `figure`
--
ALTER TABLE `figure`
  ADD CONSTRAINT `FK_2F57B37A3375BD21` FOREIGN KEY (`editeur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_2F57B37A7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`);

--
-- Contraintes pour la table `figure_figure`
--
ALTER TABLE `figure_figure`
  ADD CONSTRAINT `FK_704016F419788A72` FOREIGN KEY (`figure_target`) REFERENCES `figure` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_704016F49DDAFD` FOREIGN KEY (`figure_source`) REFERENCES `figure` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `illustration`
--
ALTER TABLE `illustration`
  ADD CONSTRAINT `FK_D67B9A425C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`);

--
-- Contraintes pour la table `utilisateur_figure`
--
ALTER TABLE `utilisateur_figure`
  ADD CONSTRAINT `FK_4EFA89F15C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4EFA89F1FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2C5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
