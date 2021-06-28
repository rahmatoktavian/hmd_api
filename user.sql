CREATE TABLE `user` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `petugas_id` int DEFAULT NULL,
  `nim` int DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `type`, `petugas_id`, `nim`, `username`, `password`) VALUES
(1, 'petugas', 1, NULL, 'rahmat', 'af2a4c9d4c4956ec9d6ba62213eed568'),
(2, 'petugas', 2, NULL, 'inna', '18aa53c0ac2859deaca6674ee136809c'),
(3, 'anggota', NULL, 100, 'dewi', 'ed1d859c50262701d92e5cbf39652792'),
(4, 'anggota', NULL, 200, 'asad', '140b543013d988f4767277b6f45ba542');

