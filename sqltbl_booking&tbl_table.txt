CREATE TABLE `tbl_booking` (
  `no` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `booking_name` varchar(100) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `booking_phone` varchar(10) NOT NULL,
  `booking_staff` varchar(100) NOT NULL,
  `dateCreate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tbl_table` (
  `id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_status` int(1) NOT NULL COMMENT '0 =ว่าง , 1 = จอง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `tbl_table` (`id`, `table_name`, `table_status`) VALUES
(1, 'A01', 1),
(2, 'A02', 0),
(3, 'A03', 0),
(4, 'A04', 0),
(5, 'A05', 1),
(6, 'B01', 0),
(7, 'B02', 0),
(8, 'B03', 0),
(9, 'B04', 0),
(10, 'B05', 0),
(11, 'C01', 0),
(12, 'C02', 0),
(13, 'C03', 0),
(14, 'C04', 0),
(15, 'C05', 0),
(16, 'D01', 0),
(17, 'D02', 0),
(18, 'D03', 0),
(19, 'D04', 0),
(20, 'D05', 0);


ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`no`);

ALTER TABLE `tbl_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_booking`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbl_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;