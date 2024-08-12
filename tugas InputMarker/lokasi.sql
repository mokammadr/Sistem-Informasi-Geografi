CREATE TABLE lokasi (
  id serial PRIMARY KEY,
  lat_long varchar,
  nama_tempat varchar,
  kategori varchar,
  keterangan text
);

SELECT * FROM lokasi

DELETE FROM lokasi WHERE kategori = 'pom bensin';

ALTER TABLE lokasi DROP COLUMN keterangan;
