-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2023 a las 03:24:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sabor_usm`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarRecetaFavorita` (IN `p_id_usuario` INT, IN `p_id_receta` INT)   BEGIN
    DECLARE existe_registro INT;

    SELECT COUNT(*) INTO existe_registro
    FROM recetas_favoritas
    WHERE id_usuario = p_id_usuario AND id_receta = p_id_receta;

    IF existe_registro = 0 THEN
        INSERT INTO recetas_favoritas (id_usuario, id_receta) VALUES (p_id_usuario, p_id_receta);
        SELECT 'Receta agregada a la lista de favoritos con éxito.' AS mensaje;
    ELSE
        SELECT 'La receta ya está en la lista de favoritos.' AS mensaje;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_ingrediente` int(11) NOT NULL,
  `nombre_ing` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id_ingrediente`, `nombre_ing`) VALUES
(1, 'Huevo'),
(2, 'Leche'),
(3, 'Frambuesa'),
(4, 'Trigo'),
(5, 'Caña de azucar'),
(6, 'Naranja'),
(7, 'Manzana'),
(8, 'Arroz'),
(9, 'Salmon'),
(10, 'Alga nori'),
(11, 'Agua'),
(12, 'Champiñon'),
(13, 'Pimiento'),
(14, 'Calabaza'),
(15, 'Pasas'),
(16, 'Mantequilla'),
(17, 'Rábano'),
(18, 'Canela'),
(19, 'Nueces'),
(20, 'Pollo'),
(21, 'Carne');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL,
  `tiempo_prep` int(11) NOT NULL,
  `instrucciones` text NOT NULL,
  `apt_diabeticos` tinyint(1) NOT NULL,
  `apt_intolerantes` tinyint(1) NOT NULL,
  `tiene_gluten` tinyint(1) NOT NULL,
  `vegano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `nombre`, `imagen`, `tipo`, `tiempo_prep`, `instrucciones`, `apt_diabeticos`, `apt_intolerantes`, `tiene_gluten`, `vegano`) VALUES
(1, 'Torta de frambuesas', './assets/img/6.png', 3, 80, '1. Precalienta el horno a 180°C.\r\n2. En un tazón grande, mezcla la harina, el azúcar, el polvo de hornear y la sal.\r\n3. En otro recipiente, bate los huevos y luego agrega la mantequilla derretida y la leche. Combina bien.\r\n4. Vierte la mezcla líquida en los ingredientes secos y revuelve hasta obtener una masa homogénea.\r\n5. Añade las frambuesas a la masa y mezcla suavemente.\r\n6. Vierte la masa en un molde para pastel previamente engrasado.\r\n7. Hornea durante 30-35 minutos o hasta que al insertar un palillo en el centro, salga limpio.', 0, 0, 1, 0),
(2, 'Crema de la pasión', './assets/img/5.png', 1, 50, 'Lava y corta rábanos en rodajas finas. En una olla, derrite mantequilla a fuego medio. Agrega cebolla picada y saltea hasta que esté transparente. Añade rábanos y cocina por unos minutos hasta que estén tiernos. Vierte caldo de verduras en la olla y lleva a ebullición. Reduce el fuego y deja cocinar a fuego lento hasta que los rábanos estén completamente tiernos. Usa una licuadora o una batidora de inmersión para mezclar la sopa hasta obtener una textura suave. Agrega crema fresca o leche según tu preferencia y vuelve a calentar sin que llegue a hervir. Condimenta con sal, pimienta y nuez moscada al gusto. Sirve caliente, decorando con cebollín picado y una cucharadita de crema fresca si lo deseas. ¡Disfruta de esta deliciosa crema de rábanos, perfecta para una comida ligera y reconfortante! Puedes ajustar los condimentos y la cantidad de crema según tus preferencias.', 1, 0, 0, 0),
(3, 'Torta de frutas', './assets/img/4.png', 3, 80, 'Precalienta el horno a 180°C. En un tazón grande, mezcla harina, azúcar, polvo de hornear y una pizca de sal. Agrega huevos, aceite vegetal y extracto de vainilla. Mezcla bien hasta obtener una masa suave. Incorpora trozos de frutas frescas como manzanas, peras y bayas. Vierte la mezcla en un molde para pastel previamente engrasado y enharinado. Hornea en el horno precalentado durante 45-50 minutos, o hasta que al insertar un palillo en el centro, este salga limpio. Mientras la torta se enfría, prepara un glaseado simple con azúcar glas y un poco de jugo de limón. Una vez que la torta esté completamente fría, cubre con el glaseado y decora con rodajas de frutas adicionales. ¡Disfruta de esta deliciosa torta de frutas, perfecta para ocasiones especiales o simplemente para consentirte a ti mismo! Puedes personalizar las frutas según la temporada y tus gustos', 0, 0, 1, 0),
(4, 'Arroz especiado con carne', './assets/img/2.png', 2, 40, 'En una olla grande, calienta el aceite de oliva y dora la carne.\r\nAgrega la cebolla y el ajo. Cocina hasta que estén transparentes.\r\nIncorpora las zanahorias y las patatas. Revuelve para mezclar.\r\nVierte suficiente caldo de carne para cubrir los ingredientes.\r\nAgrega el tomillo, la hoja de laurel, sal y pimienta.\r\nLleva a ebullición y luego reduce el fuego a bajo. Cocina a fuego lento durante 1-2 horas hasta que la carne esté tierna y los sabores se mezclen.', 1, 1, 0, 0),
(5, 'Pastel de calabaza', './assets/img/1.png', 3, 80, 'Precalienta el horno a 180°C. En un tazón grande, combina harina, azúcar, canela, nuez moscada, clavo de olor, polvo de hornear y sal. En otro tazón, mezcla puré de calabaza, aceite vegetal, huevos y extracto de vainilla. Incorpora gradualmente los ingredientes secos a la mezcla húmeda, mezclando bien. Agrega nueces o chispas de chocolate si lo deseas. Vierte la masa en un molde para pastel previamente engrasado y enharinado. Hornea en el horno precalentado durante 45-50 minutos, o hasta que al insertar un palillo en el centro, este salga limpio. Deja enfriar el pastel en el molde durante unos 10 minutos, luego transfiérelo a una rejilla para que se enfríe completamente. Opcionalmente, cubre con glaseado de queso crema o espolvorea con azúcar glass antes de servir. ¡Disfruta de este delicioso pastel de calabaza, perfecto para el otoño y las celebraciones! Puedes personalizar los ingredientes y agregar especias según tus preferencias.', 1, 1, 1, 0),
(6, 'Arroz especiado con pollo', './assets/img/3.png', 2, 40, 'Calienta aceite en una olla grande a fuego medio. Sofríe cebolla y ajo picados hasta que estén dorados. Añade trozos de pollo y cocina hasta que estén dorados por todos lados. Agrega arroz y revuelve para que se impregne con los jugos del pollo. Vierte caldo de pollo caliente sobre la mezcla. Añade zanahorias y guisantes. Condimenta con sal, pimienta, azafrán (si lo tienes) y otras especias al gusto. Reduce el fuego, tapa la olla y cocina a fuego lento hasta que el arroz esté tierno y el pollo bien cocido. Opcionalmente, decora con pimientos morrones asados o cilantro fresco antes de servir. ¡Disfruta de este reconfortante plato de arroz con pollo, lleno de sabores deliciosos! Puedes ajustar las especias y los vegetales según tus preferencias personales.', 1, 1, 0, 0),
(7, 'Flan de huevo', './assets/img/7.png', 3, 100, 'Precalienta el horno a 180°C.\r\n\r\nEn una cacerola, derrite azúcar a fuego medio para hacer caramelo. Una vez que tenga un color dorado, viértelo en el fondo de los moldes para flan.\r\n\r\nEn un tazón, bate huevos y yemas. Agrega leche condensada y leche evaporada. Mezcla bien hasta obtener una mezcla homogénea.\r\n\r\nVierte la mezcla sobre el caramelo en los moldes.\r\n\r\nColoca los moldes en una fuente para horno con agua caliente. Esto creará un baño de agua que ayudará a que el flan se cocine de manera uniforme.\r\n\r\nCubre los moldes con papel aluminio y hornea en el horno precalentado durante aproximadamente 45-60 minutos, o hasta que al insertar un palillo en el centro, este salga limpio.\r\n\r\nDeja enfriar a temperatura ambiente y luego refrigera durante al menos 4 horas o toda la noche.\r\n\r\nAl momento de servir, pasa un cuchillo alrededor del borde del molde y voltea el flan sobre un plato para que el caramelo quede en la parte superior.', 0, 0, 1, 0),
(8, 'Ensalada de fruta', './assets/img/8.png', 3, 20, 'Lava y pela todas las frutas según sea necesario. Corta las frutas en trozos o rodajas. En un tazón grande, combina sandía, piña, fresas, uvas, plátano, kiwi y gajos de naranja. En un tazón pequeño, mezcla miel, jugo de limón y ralladura de limón para hacer el aderezo. Vierte el aderezo sobre las frutas y mezcla suavemente para que todas las frutas estén cubiertas. Refrigera la ensalada durante al menos 30 minutos antes de servir para que los sabores se mezclen. Justo antes de servir, decora con hojas de menta fresca si lo deseas.', 0, 1, 0, 1),
(9, 'Arroz con cangrejo', './assets/img/9.png', 2, 100, 'Lava y pela todas las frutas según sea necesario. Corta las frutas en trozos o rodajas. En un tazón grande, combina arroz cocido con carne de cangrejo desmenuzada. Añade dados de aguacate, maíz fresco y tomates cherry cortados por la mitad. En un tazón pequeño, mezcla aceite de oliva, jugo de limón, cilantro fresco picado, sal y pimienta para hacer el aderezo. Vierte el aderezo sobre la mezcla de arroz y cangrejo, y mezcla suavemente para que todos los ingredientes estén bien combinados. Refrigera la ensalada durante al menos 30 minutos antes de servir para que los sabores se mezclen. Justo antes de servir, decora con rodajas de limón y hojas de cilantro fresco. ¡Disfruta de este delicioso arroz con cangrejo, perfecto para una comida fresca y veraniega! Puedes ajustar los ingredientes según tus preferencias personales.', 1, 1, 0, 0),
(10, 'Estofado de Calabaza', './assets/img/14.png', 2, 60, 'En una olla grande, saltea la cebolla hasta que esté transparente.\r\nAgrega la calabaza y las zanahorias. Cocina por unos minutos.\r\nAñade el caldo de verduras, garbanzos, comino, cilantro, hoja de laurel, sal y pimienta.\r\nLleva a ebullición y luego reduce el fuego. Cocina a fuego lento hasta que las verduras estén tiernas.\r\nSirve caliente, espolvorea con perejil fresco antes de servir.', 1, 1, 0, 1),
(11, 'Salteado de champiñones', './assets/img/10.png', 1, 120, 'Lava y corta champiñones en rodajas. Calienta aceite de oliva en una sartén grande a fuego medio. Añade champiñones y saltea hasta que estén dorados. Agrega cebolla, pimientos y calabacín cortados en tiras finas. Cocina hasta que las verduras estén tiernas pero aún crujientes. Agrega ajo picado y revuelve bien durante unos minutos hasta que el ajo libere su aroma. Condimenta con sal, pimienta, y hierbas frescas como tomillo o romero al gusto. Exprime un poco de jugo de limón sobre la mezcla para realzar los sabores. Justo antes de servir, espolvorea perejil fresco picado para un toque de frescura. ¡Disfruta de estos champiñones salteados con verduras como un delicioso acompañamiento o sobre una cama de arroz o quinoa! Puedes ajustar los ingredientes y las especias según tus preferencias personales.', 1, 1, 0, 1),
(12, 'Sopa de verduras', './assets/img/11.png', 1, 70, 'Calienta aceite de oliva en una olla grande a fuego medio. Saltea cebolla y ajo picados hasta que estén dorados y fragantes. Agrega zanahorias, apio y calabacín en trozos, y cocina por unos minutos. Vierte caldo de verduras en la olla y lleva la mezcla a ebullición. Reduce el fuego y deja cocinar a fuego lento hasta que las verduras estén tiernas. Agrega judías verdes y guisantes congelados, y cocina hasta que estén calientes. Condimenta con sal, pimienta, y hierbas frescas como tomillo o perejil al gusto. Opcionalmente, añade fideos pequeños o arroz cocido para hacer la sopa más sustanciosa. Justo antes de servir, exprime un poco de jugo de limón para realzar los sabores. ¡Disfruta de esta sopa de verduras reconfortante y nutritiva! Puedes ajustar los ingredientes y las especias según tus preferencias personales.', 1, 1, 0, 1),
(13, 'Manzana rellena', './assets/img/15.png', 3, 40, 'Precalienta el horno a 180°C.\r\nLava las manzanas y córtales la parte superior, creando un agujero en el centro.\r\nCon una cuchara, retira el corazón y las semillas, creando un espacio para el relleno.\r\nEn un tazón, mezcla la avena, nueces, miel, canela y pasas.\r\nRellena cada manzana con la mezcla, presionando ligeramente.\r\nVierte la mantequilla derretida sobre las manzanas rellenas.\r\nColoca las manzanas en una bandeja para horno y hornea durante 25-30 minutos, o hasta que estén tiernas.\r\nSi lo deseas, sirve las manzanas rellenas con una cucharada de yogur griego encima.', 1, 0, 0, 0),
(14, 'Pescado con pimientos', './assets/img/12.png', 3, 50, 'Marina filetes de pescado (como el salmón o la tilapia) con jugo de limón, ajo picado, sal, pimienta y una pizca de pimentón. Deja marinar durante al menos 30 minutos. Precalienta la parrilla a fuego medio-alto. Corta pimientos de colores en tiras. Puedes utilizar pimientos rojos, verdes y amarillos para añadir color y sabor. Coloca los filetes de pescado marinados y las tiras de pimientos en la parrilla caliente. Cocina el pescado durante 4-5 minutos por cada lado, o hasta que esté bien cocido y se desmenuce fácilmente con un tenedor. Mientras se cocina, voltea ocasionalmente las tiras de pimientos hasta que estén tiernas y ligeramente doradas. Sirve el pescado sobre una cama de pimientos asados y decora con rodajas de limón y perejil fresco. ¡Disfruta de esta sabrosa y saludable receta de pescado con pimientos a la parrilla! Puedes ajustar las especias y los tipos de pescado según tus preferencias personales.', 1, 1, 0, 0),
(15, 'Onigiri del bosque', './assets/img/16.png', 1, 70, ' Enjuaga el arroz bajo agua fría hasta que el agua salga clara.\r\nCocina el arroz con las 2 1/2 tazas de agua según las instrucciones del paquete.\r\nCalienta el vinagre de arroz, azúcar y sal en una cacerola hasta que se disuelvan.\r\nVierte la mezcla sobre el arroz cocido y mezcla bien. Deja enfriar.\r\n\r\nArmar los Onigiri:\r\nHumedece tus manos y espolvorea sal para evitar que el arroz se pegue.\r\nToma una porción de arroz y forma una bola.\r\nHaz un hueco en el centro y coloca el relleno deseado.\r\nCubre el relleno con más arroz y forma un triángulo o bola.\r\n\r\nEnvoltura de Alga Nori (opcional):\r\nCorta tiras finas de alga nori.\r\nEnvuelve los Onigiri con las tiras de nori, si lo deseas.\r\nServir:\r\n\r\nSirve los Onigiri del Bosque Encantado como una deliciosa opción con un toque mágico.\r\nDecora con sésamo tostado o furikake para un sabor adicional.', 0, 1, 1, 0),
(16, 'Arroz con huevo', './assets/img/13.png', 2, 90, '    Preparar el Arroz:\r\n    Cocina el arroz según las instrucciones del paquete y deja enfriar.\r\n\r\n    Revolver los Huevos:\r\n    Bate los huevos en un tazón y agrégales una pizca de sal.\r\n\r\n    Cocinar el Huevo Revuelto:\r\n    Calienta una sartén grande o un wok a fuego medio-alto.\r\n    Añade un poco de aceite de sésamo y vierte los huevos batidos.\r\n    Revuelve constantemente hasta que estén cocidos pero aún tiernos.\r\n    Retira los huevos de la sartén y resérvalos.\r\n\r\n    Saltear las Verduras:\r\n    En la misma sartén, agrega un poco más de aceite de sésamo.\r\n    Saltea los guisantes y la zanahoria rallada hasta que estén tiernos.\r\n\r\n    Mezclar el Arroz y la Salsa:\r\n    Agrega el arroz cocido a la sartén con las verduras.\r\n    Vierte la salsa de soja y el jengibre rallado sobre el arroz.\r\n    Revuelve bien para que los ingredientes se mezclen y se impregnen con la salsa.\r\n\r\n    Agregar el Huevo Revuelto:\r\n    Incorpora los huevos revueltos a la mezcla de arroz y verduras.\r\n    Revuelve suavemente para distribuir los ingredientes de manera uniforme.\r\n', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_favoritas`
--

CREATE TABLE `recetas_favoritas` (
  `id_relacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_receta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas_favoritas`
--

INSERT INTO `recetas_favoritas` (`id_relacion`, `id_usuario`, `id_receta`) VALUES
(1, 6, 1),
(2, 6, 2),
(3, 6, 3),
(5, 6, 6),
(6, 6, 5),
(7, 10, 1),
(8, 10, 3),
(9, 10, 7),
(10, 6, 7),
(11, 6, 4),
(12, 10, 5),
(13, 22, 2),
(14, 22, 16),
(15, 22, 12),
(16, 22, 3),
(17, 22, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_ingredientes`
--

CREATE TABLE `recetas_ingredientes` (
  `id_relacion` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `cantidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas_ingredientes`
--

INSERT INTO `recetas_ingredientes` (`id_relacion`, `id_receta`, `id_ingrediente`, `cantidad`) VALUES
(1, 1, 3, '50gramos'),
(2, 1, 5, '100gramos'),
(3, 2, 2, '30ml'),
(4, 2, 1, '2'),
(10, 2, 17, '30gramos'),
(11, 3, 7, '4'),
(12, 4, 8, '150gramos'),
(13, 4, 21, '200gramos'),
(14, 5, 14, '1'),
(15, 5, 4, '50gramos'),
(16, 3, 4, '50gramos'),
(17, 3, 19, '300gramos'),
(18, 6, 8, '200gramos'),
(19, 6, 20, '100gramos'),
(20, 7, 1, '3'),
(21, 7, 4, '400gramos'),
(22, 8, 13, '100gramos'),
(23, 8, 6, '100gramos'),
(24, 8, 7, '150gramos'),
(25, 9, 8, '200gramos'),
(26, 9, 19, '100gramos'),
(27, 10, 13, '100gramos'),
(28, 10, 14, '1'),
(29, 11, 12, '200gramos'),
(30, 11, 16, '50gramos'),
(31, 12, 17, '100gramos'),
(32, 12, 11, '200ml'),
(33, 13, 7, '4'),
(34, 13, 16, '100gramos'),
(35, 14, 9, '200gramos'),
(36, 14, 13, '100gramos'),
(37, 15, 10, '3 láminas'),
(38, 15, 8, '100gramos'),
(39, 16, 8, '100gramos'),
(40, 16, 1, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `id_reseña` int(11) NOT NULL,
  `id_receta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reseñas`
--

INSERT INTO `reseñas` (`id_reseña`, `id_receta`, `id_usuario`, `calificacion`, `comentario`, `fecha`) VALUES
(1, 1, 6, 5, 'MUY BACAN GRACIAS', '2023-11-12 15:11:24'),
(2, 2, 6, 3, 'NOSE DEMÁS', '2023-11-12 15:16:10'),
(3, 2, 6, 1, 'MENTIRA', '2023-11-12 15:16:10'),
(4, 3, 6, 5, 'PIOLA', '2023-11-12 20:15:30'),
(9, 2, 6, 1, 'LOL', '2023-11-14 06:52:59'),
(16, 2, 6, 1, '', '2023-11-14 07:16:32'),
(17, 2, 6, 1, 'asd', '2023-11-14 07:16:48'),
(18, 4, 6, 5, 'EEEEEEEEEE', '2023-11-14 07:18:06'),
(19, 5, 6, 2, 'NOSE\r\n', '2023-11-14 07:18:31'),
(20, 1, 6, 1, 'asd', '2023-11-14 07:37:38'),
(22, 3, 10, 5, 'OLA SI BUENO BUEN9O', '2023-11-14 08:17:57'),
(23, 7, 10, 1, 'EEEEEEE', '2023-11-14 08:18:13'),
(24, 6, 10, 1, 'EEEEEEEEEEEASD', '2023-11-14 08:18:22'),
(26, 1, 10, 5, 'LOL', '2023-11-15 01:43:52'),
(27, 12, 22, 3, 'AHI NOMAS MMMMMMMMMMMMMMMMMMMMMMM', '2023-11-15 02:49:51'),
(28, 16, 22, 5, 'BRILLANTE', '2023-11-15 02:50:42'),
(29, 15, 22, 5, 'FENOMENAL ', '2023-11-15 02:50:57'),
(30, 14, 22, 1, 'PENCA', '2023-11-15 02:51:05'),
(31, 13, 22, 2, '???????', '2023-11-15 02:51:20'),
(32, 12, 22, 5, 'EEEE', '2023-11-15 02:51:33'),
(33, 11, 22, 4, 'RRRIKO', '2023-11-15 02:51:45'),
(34, 10, 22, 3, 'MAOMENO', '2023-11-15 02:51:58'),
(35, 9, 22, 2, 'CANGREJO?????????', '2023-11-15 02:52:12'),
(36, 8, 22, 4, 'EU JAMES EU QUERO UMA SALADA DO FRUTA', '2023-11-15 02:52:31'),
(37, 2, 6, 2, '', '2023-11-15 02:53:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_message_temp`
--

CREATE TABLE `user_message_temp` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `redirect_page` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_message_temp`
--

INSERT INTO `user_message_temp` (`id`, `message`, `redirect_page`) VALUES
(9, 'Usuario actualizado correctamente', 'info.php'),
(10, 'Usuario actualizado correctamente', 'info.php'),
(11, 'Usuario actualizado correctamente', 'info.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `correo` varchar(35) NOT NULL,
  `contraseña` varchar(30) DEFAULT NULL,
  `ultima_sesion` datetime DEFAULT NULL,
  `cant_almuerzos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contraseña`, `ultima_sesion`, `cant_almuerzos`) VALUES
(6, ' Matias Torrejon  ', 'matiast.r@hotmail.com', '123', '2023-11-15 02:53:07', 999),
(10, 'Renato Ramirez', 'renato.ramirez@usm.cl', '123', '2023-11-14 07:37:49', 1),
(12, 'BUENAS TARDES', 'ola@si.com', '123', NULL, 0),
(13, 'ASD', 'ASD', 'ASD', '2023-11-15 02:48:12', 0),
(14, 'colina', '1', '2', NULL, 0),
(15, 'JORGE SAMPAOLI', 'jorgito@parillero.cl', '123123', NULL, 0),
(16, 'ok', 'ok@ok.cl', 'ok', NULL, 0),
(17, '1', '1', '1', NULL, 0),
(18, 'ggg', 'ggg', 'ggg', NULL, 0),
(19, 'bbb', 'bbb', 'bbb', NULL, 0),
(20, 'nn', 'nn', 'nn', '2023-11-15 02:47:45', 0),
(21, 'ggh', 'ggh', 'ggh', NULL, 0),
(22, 'LOL 123', 'LOL', 'LOL', '2023-11-15 02:49:15', 0);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `after_insert_usuario` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
    DECLARE v_nombre VARCHAR(255);
    DECLARE v_correo VARCHAR(255);
    DECLARE v_contrasena VARCHAR(255);

    -- Ajusta según sea necesario
    SELECT nombre, correo, contraseña INTO v_nombre, v_correo, v_contrasena
    FROM usuarios
    WHERE id_usuario = NEW.id_usuario;

    -- Puedes realizar otras acciones aquí si es necesario
    -- ...

    INSERT INTO user_message_temp (message, redirect_page)
    VALUES ('Usuario actualizado correctamente', 'info.php');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_recetas_favoritas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_recetas_favoritas` (
`id_receta` int(11)
,`nombre` varchar(50)
,`imagen` varchar(100)
,`tipo` int(11)
,`promedio_calificaciones` decimal(11,0)
,`id_usuario` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_recetas_favoritas`
--
DROP TABLE IF EXISTS `vista_recetas_favoritas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_recetas_favoritas`  AS SELECT `rec`.`id_receta` AS `id_receta`, `rec`.`nombre` AS `nombre`, `rec`.`imagen` AS `imagen`, `rec`.`tipo` AS `tipo`, round(avg(`res`.`calificacion`),0) AS `promedio_calificaciones`, `rf`.`id_usuario` AS `id_usuario` FROM ((`recetas` `rec` left join `reseñas` `res` on(`rec`.`id_receta` = `res`.`id_receta`)) join `recetas_favoritas` `rf` on(`rec`.`id_receta` = `rf`.`id_receta`)) GROUP BY `rec`.`id_receta`, `rec`.`nombre`, `rec`.`imagen`, `rec`.`tipo`, `rf`.`id_usuario` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_ingrediente`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`);

--
-- Indices de la tabla `recetas_favoritas`
--
ALTER TABLE `recetas_favoritas`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_receta` (`id_receta`);

--
-- Indices de la tabla `recetas_ingredientes`
--
ALTER TABLE `recetas_ingredientes`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `recetas_id_receta_recetas_ingredientes` (`id_receta`),
  ADD KEY `ingredientes_id_ingrediente_recetas_ingredientes` (`id_ingrediente`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id_reseña`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `reseñas_ibfk_2` (`id_usuario`);

--
-- Indices de la tabla `user_message_temp`
--
ALTER TABLE `user_message_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `recetas_favoritas`
--
ALTER TABLE `recetas_favoritas`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `recetas_ingredientes`
--
ALTER TABLE `recetas_ingredientes`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `id_reseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `user_message_temp`
--
ALTER TABLE `user_message_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recetas_favoritas`
--
ALTER TABLE `recetas_favoritas`
  ADD CONSTRAINT `recetas_favoritas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `recetas_favoritas_ibfk_2` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recetas_ingredientes`
--
ALTER TABLE `recetas_ingredientes`
  ADD CONSTRAINT `ingredientes_id_ingrediente_recetas_ingredientes` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes` (`id_ingrediente`),
  ADD CONSTRAINT `recetas_id_receta_recetas_ingredientes` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`),
  ADD CONSTRAINT `reseñas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
