--
-- PostgreSQL database dump
--

\restrict yMugrfGwXzRlNtRnxpA0savO4UuIfyJaf03dN8LzrHzcGxEc5m2VWcqnmuOOFlf

-- Dumped from database version 16.10 (Ubuntu 16.10-0ubuntu0.24.04.1)
-- Dumped by pg_dump version 16.10 (Ubuntu 16.10-0ubuntu0.24.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: guru; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.guru (
    id bigint NOT NULL,
    nip character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    tempat_lahir character varying(255) NOT NULL,
    tanggal_lahir date NOT NULL,
    alamat text NOT NULL,
    telepon character varying(255),
    email character varying(255),
    sekolah_id bigint NOT NULL,
    status_pegawai_id bigint NOT NULL,
    pendidikan_id bigint NOT NULL,
    mapel_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.guru OWNER TO postgres;

--
-- Name: guru_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.guru_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.guru_id_seq OWNER TO postgres;

--
-- Name: guru_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.guru_id_seq OWNED BY public.guru.id;


--
-- Name: guru_prestasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.guru_prestasi (
    id bigint NOT NULL,
    guru_id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    tingkat_id bigint NOT NULL,
    prestasi_guru character varying(255) NOT NULL,
    keterangan character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.guru_prestasi OWNER TO postgres;

--
-- Name: guru_prestasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.guru_prestasi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.guru_prestasi_id_seq OWNER TO postgres;

--
-- Name: guru_prestasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.guru_prestasi_id_seq OWNED BY public.guru_prestasi.id;


--
-- Name: hak_akses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.hak_akses (
    id bigint NOT NULL,
    hak_akses character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.hak_akses OWNER TO postgres;

--
-- Name: hak_akses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.hak_akses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.hak_akses_id_seq OWNER TO postgres;

--
-- Name: hak_akses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.hak_akses_id_seq OWNED BY public.hak_akses.id;


--
-- Name: jabatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jabatan (
    id bigint NOT NULL,
    jabatan character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.jabatan OWNER TO postgres;

--
-- Name: jabatan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jabatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jabatan_id_seq OWNER TO postgres;

--
-- Name: jabatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jabatan_id_seq OWNED BY public.jabatan.id;


--
-- Name: jam; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jam (
    id bigint NOT NULL,
    mapel_id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    jam_kelas_x integer,
    jam_kelas_xi integer,
    jam_kelas_xii integer,
    jam_kelas_xiii integer,
    total_jam integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.jam OWNER TO postgres;

--
-- Name: jam_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jam_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jam_id_seq OWNER TO postgres;

--
-- Name: jam_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jam_id_seq OWNED BY public.jam.id;


--
-- Name: jenjang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jenjang (
    id bigint NOT NULL,
    nama_jenjang character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.jenjang OWNER TO postgres;

--
-- Name: jenjang_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jenjang_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jenjang_id_seq OWNER TO postgres;

--
-- Name: jenjang_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jenjang_id_seq OWNED BY public.jenjang.id;


--
-- Name: jurusan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jurusan (
    id bigint NOT NULL,
    nama_jurusan character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.jurusan OWNER TO postgres;

--
-- Name: jurusan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jurusan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jurusan_id_seq OWNER TO postgres;

--
-- Name: jurusan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jurusan_id_seq OWNED BY public.jurusan.id;


--
-- Name: kategori_sekolah; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori_sekolah (
    id bigint NOT NULL,
    kategori_sekolah character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.kategori_sekolah OWNER TO postgres;

--
-- Name: kategori_sekolah_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kategori_sekolah_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kategori_sekolah_id_seq OWNER TO postgres;

--
-- Name: kategori_sekolah_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kategori_sekolah_id_seq OWNED BY public.kategori_sekolah.id;


--
-- Name: kecamatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kecamatan (
    id bigint NOT NULL,
    nama_kecamatan character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.kecamatan OWNER TO postgres;

--
-- Name: kecamatan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kecamatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kecamatan_id_seq OWNER TO postgres;

--
-- Name: kecamatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kecamatan_id_seq OWNED BY public.kecamatan.id;


--
-- Name: mapel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mapel (
    id bigint NOT NULL,
    nama_mapel character varying(255) NOT NULL,
    blok character varying(255) NOT NULL,
    jurusan_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.mapel OWNER TO postgres;

--
-- Name: mapel_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mapel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mapel_id_seq OWNER TO postgres;

--
-- Name: mapel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mapel_id_seq OWNED BY public.mapel.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: old_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.old_user (
    id bigint NOT NULL,
    users_id bigint NOT NULL,
    first_password character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.old_user OWNER TO postgres;

--
-- Name: old_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.old_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.old_user_id_seq OWNER TO postgres;

--
-- Name: old_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.old_user_id_seq OWNED BY public.old_user.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: pendidikan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pendidikan (
    id bigint NOT NULL,
    pendidikan character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pendidikan OWNER TO postgres;

--
-- Name: pendidikan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pendidikan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pendidikan_id_seq OWNER TO postgres;

--
-- Name: pendidikan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pendidikan_id_seq OWNED BY public.pendidikan.id;


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: prestasis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prestasis (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.prestasis OWNER TO postgres;

--
-- Name: prestasis_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prestasis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.prestasis_id_seq OWNER TO postgres;

--
-- Name: prestasis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prestasis_id_seq OWNED BY public.prestasis.id;


--
-- Name: ptk; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ptk (
    id bigint NOT NULL,
    nip character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    tempat_lahir text NOT NULL,
    tanggal_lahir date NOT NULL,
    alamat text NOT NULL,
    telepon character varying(255),
    email character varying(255),
    jabatan character varying(255) NOT NULL,
    sekolah_id bigint NOT NULL,
    status_pegawai_id bigint NOT NULL,
    pendidikan_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ptk OWNER TO postgres;

--
-- Name: ptk_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ptk_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ptk_id_seq OWNER TO postgres;

--
-- Name: ptk_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ptk_id_seq OWNED BY public.ptk.id;


--
-- Name: rombel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rombel (
    id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    jurusan_id bigint NOT NULL,
    kelas_10 integer,
    kelas_11 integer,
    kelas_12 integer,
    kelas_13 integer,
    keterangan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.rombel OWNER TO postgres;

--
-- Name: rombel_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rombel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rombel_id_seq OWNER TO postgres;

--
-- Name: rombel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rombel_id_seq OWNED BY public.rombel.id;


--
-- Name: ruangan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ruangan (
    id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    ruangan character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ruangan OWNER TO postgres;

--
-- Name: ruangan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ruangan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ruangan_id_seq OWNER TO postgres;

--
-- Name: ruangan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ruangan_id_seq OWNED BY public.ruangan.id;


--
-- Name: sapras; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sapras (
    id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    ruangan_id bigint NOT NULL,
    nama character varying(255) NOT NULL,
    kondisi_baik integer,
    kondisi_sedang integer,
    kondisi_berat integer,
    keterangan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.sapras OWNER TO postgres;

--
-- Name: sapras_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sapras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sapras_id_seq OWNER TO postgres;

--
-- Name: sapras_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sapras_id_seq OWNED BY public.sapras.id;


--
-- Name: sekolah; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sekolah (
    id bigint NOT NULL,
    kecamatan_id bigint NOT NULL,
    jenjang_id bigint NOT NULL,
    kategori_sekolah_id bigint NOT NULL,
    npsn character varying(255),
    nss character varying(255),
    kepala_sekolah character varying(255),
    profile_image character varying(255),
    nama character varying(255) NOT NULL,
    alamat text,
    telepon character varying(255),
    fax character varying(255),
    email character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.sekolah OWNER TO postgres;

--
-- Name: sekolah_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sekolah_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sekolah_id_seq OWNER TO postgres;

--
-- Name: sekolah_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sekolah_id_seq OWNED BY public.sekolah.id;


--
-- Name: siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.siswa (
    id bigint NOT NULL,
    rombel_id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    kelas_10 character varying(255),
    kelas_11 character varying(255),
    kelas_12 character varying(255),
    kelas_13 character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.siswa OWNER TO postgres;

--
-- Name: siswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.siswa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.siswa_id_seq OWNER TO postgres;

--
-- Name: siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_id_seq OWNED BY public.siswa.id;


--
-- Name: siswa_prestasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.siswa_prestasi (
    id bigint NOT NULL,
    nis character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    kelas character varying(255) NOT NULL,
    prestasi_siswa character varying(255) NOT NULL,
    event character varying(255) NOT NULL,
    tanggal_event date NOT NULL,
    tingkat_id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    keterangan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.siswa_prestasi OWNER TO postgres;

--
-- Name: siswa_prestasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.siswa_prestasi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.siswa_prestasi_id_seq OWNER TO postgres;

--
-- Name: siswa_prestasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_prestasi_id_seq OWNED BY public.siswa_prestasi.id;


--
-- Name: status_pegawai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.status_pegawai (
    id bigint NOT NULL,
    status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.status_pegawai OWNER TO postgres;

--
-- Name: status_pegawai_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.status_pegawai_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.status_pegawai_id_seq OWNER TO postgres;

--
-- Name: status_pegawai_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.status_pegawai_id_seq OWNED BY public.status_pegawai.id;


--
-- Name: tingkat_kebutuhan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tingkat_kebutuhan (
    id bigint NOT NULL,
    jam_id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    quota integer,
    lebih integer,
    kurang integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tingkat_kebutuhan OWNER TO postgres;

--
-- Name: tingkat_kebutuhan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tingkat_kebutuhan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tingkat_kebutuhan_id_seq OWNER TO postgres;

--
-- Name: tingkat_kebutuhan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tingkat_kebutuhan_id_seq OWNED BY public.tingkat_kebutuhan.id;


--
-- Name: tingkat_prestasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tingkat_prestasi (
    id bigint NOT NULL,
    nama_tingkat character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tingkat_prestasi OWNER TO postgres;

--
-- Name: tingkat_prestasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tingkat_prestasi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tingkat_prestasi_id_seq OWNER TO postgres;

--
-- Name: tingkat_prestasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tingkat_prestasi_id_seq OWNED BY public.tingkat_prestasi.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    hak_akses_id bigint NOT NULL,
    sekolah_id bigint,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: guru id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru ALTER COLUMN id SET DEFAULT nextval('public.guru_id_seq'::regclass);


--
-- Name: guru_prestasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru_prestasi ALTER COLUMN id SET DEFAULT nextval('public.guru_prestasi_id_seq'::regclass);


--
-- Name: hak_akses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.hak_akses ALTER COLUMN id SET DEFAULT nextval('public.hak_akses_id_seq'::regclass);


--
-- Name: jabatan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan ALTER COLUMN id SET DEFAULT nextval('public.jabatan_id_seq'::regclass);


--
-- Name: jam id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jam ALTER COLUMN id SET DEFAULT nextval('public.jam_id_seq'::regclass);


--
-- Name: jenjang id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenjang ALTER COLUMN id SET DEFAULT nextval('public.jenjang_id_seq'::regclass);


--
-- Name: jurusan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jurusan ALTER COLUMN id SET DEFAULT nextval('public.jurusan_id_seq'::regclass);


--
-- Name: kategori_sekolah id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori_sekolah ALTER COLUMN id SET DEFAULT nextval('public.kategori_sekolah_id_seq'::regclass);


--
-- Name: kecamatan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kecamatan ALTER COLUMN id SET DEFAULT nextval('public.kecamatan_id_seq'::regclass);


--
-- Name: mapel id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mapel ALTER COLUMN id SET DEFAULT nextval('public.mapel_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: old_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.old_user ALTER COLUMN id SET DEFAULT nextval('public.old_user_id_seq'::regclass);


--
-- Name: pendidikan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan ALTER COLUMN id SET DEFAULT nextval('public.pendidikan_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: prestasis id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestasis ALTER COLUMN id SET DEFAULT nextval('public.prestasis_id_seq'::regclass);


--
-- Name: ptk id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ptk ALTER COLUMN id SET DEFAULT nextval('public.ptk_id_seq'::regclass);


--
-- Name: rombel id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rombel ALTER COLUMN id SET DEFAULT nextval('public.rombel_id_seq'::regclass);


--
-- Name: ruangan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ruangan ALTER COLUMN id SET DEFAULT nextval('public.ruangan_id_seq'::regclass);


--
-- Name: sapras id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sapras ALTER COLUMN id SET DEFAULT nextval('public.sapras_id_seq'::regclass);


--
-- Name: sekolah id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sekolah ALTER COLUMN id SET DEFAULT nextval('public.sekolah_id_seq'::regclass);


--
-- Name: siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa ALTER COLUMN id SET DEFAULT nextval('public.siswa_id_seq'::regclass);


--
-- Name: siswa_prestasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_prestasi ALTER COLUMN id SET DEFAULT nextval('public.siswa_prestasi_id_seq'::regclass);


--
-- Name: status_pegawai id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.status_pegawai ALTER COLUMN id SET DEFAULT nextval('public.status_pegawai_id_seq'::regclass);


--
-- Name: tingkat_kebutuhan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tingkat_kebutuhan ALTER COLUMN id SET DEFAULT nextval('public.tingkat_kebutuhan_id_seq'::regclass);


--
-- Name: tingkat_prestasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tingkat_prestasi ALTER COLUMN id SET DEFAULT nextval('public.tingkat_prestasi_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: guru; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.guru (id, nip, nama, tempat_lahir, tanggal_lahir, alamat, telepon, email, sekolah_id, status_pegawai_id, pendidikan_id, mapel_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: guru_prestasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.guru_prestasi (id, guru_id, sekolah_id, tingkat_id, prestasi_guru, keterangan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: hak_akses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.hak_akses (id, hak_akses, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jabatan (id, jabatan, created_at, updated_at) FROM stdin;
1	Ketua Komite	\N	\N
2	Kepala Sekolah	\N	\N
3	Kepala Tata Usaha	\N	\N
4	Wakil SARPRASHUM	\N	\N
5	Wakil Kurikulum	\N	\N
6	Wakil Kesiswaan	\N	\N
7	Pembina OSIS	\N	\N
8	Koordinator Ekstrakulikuler	\N	\N
9	Kepala LAB	\N	\N
10	Kepala Perpustakaan	\N	\N
11	Guru Bimbingan Konseling	\N	\N
12	Guru Mata Pelajaran	\N	\N
13	Wali Kelas	\N	\N
14	Guru Piket	\N	\N
\.


--
-- Data for Name: jam; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jam (id, mapel_id, sekolah_id, jam_kelas_x, jam_kelas_xi, jam_kelas_xii, jam_kelas_xiii, total_jam, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: jenjang; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jenjang (id, nama_jenjang, created_at, updated_at) FROM stdin;
1	Sekolah Menengah Atas	\N	\N
2	Sekolah Menengah Kejuruan	\N	\N
3	Sekolah Luar Biasa	\N	\N
\.


--
-- Data for Name: jurusan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jurusan (id, nama_jurusan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: kategori_sekolah; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kategori_sekolah (id, kategori_sekolah, created_at, updated_at) FROM stdin;
1	Swasta	\N	\N
2	Negeri	\N	\N
\.


--
-- Data for Name: kecamatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kecamatan (id, nama_kecamatan, created_at, updated_at) FROM stdin;
1	Gambir	\N	\N
\.


--
-- Data for Name: mapel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mapel (id, nama_mapel, blok, jurusan_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2021_10_04_081243_create_guru_table	1
6	2021_10_04_082034_create_ptk_table	1
7	2021_10_04_082228_create_jabatan_table	1
8	2021_10_04_082542_create_jurusan_table	1
9	2021_10_04_083114_create_kecamatan_table	1
10	2021_10_04_083300_create_pendidikan_table	1
11	2021_10_04_083338_create_status_pegawai_table	1
12	2021_10_05_162516_create_jam_table	1
13	2021_10_05_162923_create_sekolah_table	1
14	2021_10_06_1633486991_create_guru_prestasi_table	1
15	2021_10_06_1633487136_create_rombel_table	1
16	2021_10_06_1633487251_create_sapras_table	1
17	2021_10_06_1633487331_create_siswa_prestasi_table	1
18	2021_10_06_1633487420_create_jenjang_table	1
19	2021_10_06_1633487507_create_mapel_table	1
20	2021_10_06_1633487600_create_tingkat_prestasi_table	1
21	2021_10_09_230436_create_hak_akses_table	1
22	2021_10_13_125312_create_tingkat_kebutuhan_table	1
23	2021_10_19_040618_create_siswa_table	1
24	2021_10_21_012726_create_kategori_sekolah_table	1
25	2021_10_23_054641_create_old_user_table	1
26	2021_12_21_045551_create_ruangan_table	1
27	2023_02_01_032126_create_prestasis_table	1
\.


--
-- Data for Name: old_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.old_user (id, users_id, first_password, username, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: pendidikan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pendidikan (id, pendidikan, created_at, updated_at) FROM stdin;
1	Sarjana 1	\N	\N
2	Sarjana 2	\N	\N
3	Sarjana 3	\N	\N
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: prestasis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prestasis (id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: ptk; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ptk (id, nip, nama, tempat_lahir, tanggal_lahir, alamat, telepon, email, jabatan, sekolah_id, status_pegawai_id, pendidikan_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: rombel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rombel (id, sekolah_id, jurusan_id, kelas_10, kelas_11, kelas_12, kelas_13, keterangan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: ruangan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ruangan (id, sekolah_id, ruangan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: sapras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sapras (id, sekolah_id, ruangan_id, nama, kondisi_baik, kondisi_sedang, kondisi_berat, keterangan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: sekolah; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sekolah (id, kecamatan_id, jenjang_id, kategori_sekolah_id, npsn, nss, kepala_sekolah, profile_image, nama, alamat, telepon, fax, email, created_at, updated_at) FROM stdin;
1	1	2	3	12345678	987654321	Budi Santoso	default.png	SD Negeri Contoh	Jl. Mawar No. 10	0211234567	0217654321	sekolah@example.com	2025-11-25 14:37:33	2025-11-25 14:37:33
\.


--
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, rombel_id, sekolah_id, kelas_10, kelas_11, kelas_12, kelas_13, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: siswa_prestasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa_prestasi (id, nis, nama, kelas, prestasi_siswa, event, tanggal_event, tingkat_id, sekolah_id, keterangan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: status_pegawai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.status_pegawai (id, status, created_at, updated_at) FROM stdin;
1	PNS	\N	\N
2	Non PNS	\N	\N
\.


--
-- Data for Name: tingkat_kebutuhan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tingkat_kebutuhan (id, jam_id, sekolah_id, quota, lebih, kurang, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: tingkat_prestasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tingkat_prestasi (id, nama_tingkat, created_at, updated_at) FROM stdin;
1	Kecamatan	\N	\N
2	Kabupaten/Kota	\N	\N
3	Provinsi	\N	\N
4	Nasional	\N	\N
5	Internasional	\N	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, password, hak_akses_id, sekolah_id, remember_token, created_at, updated_at) FROM stdin;
1	kcd	$2y$10$CL66lvE7IeqmFXXlJZ1t9.RRRbtdaKufgXROaKlPrkPLfk2gsYP0a	1	1	0EoeVaqoxCLHIqqzxDySGFP8pPJ25f5DmQt0Xq9frV2U37fn5IiUHHqiASgv	2025-11-25 06:52:32	2025-11-25 06:52:32
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: guru_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.guru_id_seq', 1, false);


--
-- Name: guru_prestasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.guru_prestasi_id_seq', 1, false);


--
-- Name: hak_akses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.hak_akses_id_seq', 1, false);


--
-- Name: jabatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jabatan_id_seq', 14, true);


--
-- Name: jam_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jam_id_seq', 1, false);


--
-- Name: jenjang_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jenjang_id_seq', 3, true);


--
-- Name: jurusan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jurusan_id_seq', 1, false);


--
-- Name: kategori_sekolah_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kategori_sekolah_id_seq', 2, true);


--
-- Name: kecamatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kecamatan_id_seq', 1, true);


--
-- Name: mapel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mapel_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 27, true);


--
-- Name: old_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.old_user_id_seq', 1, false);


--
-- Name: pendidikan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pendidikan_id_seq', 3, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: prestasis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prestasis_id_seq', 1, false);


--
-- Name: ptk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ptk_id_seq', 1, false);


--
-- Name: rombel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rombel_id_seq', 1, false);


--
-- Name: ruangan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ruangan_id_seq', 1, false);


--
-- Name: sapras_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sapras_id_seq', 1, false);


--
-- Name: sekolah_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sekolah_id_seq', 1, true);


--
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 1, false);


--
-- Name: siswa_prestasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_prestasi_id_seq', 1, false);


--
-- Name: status_pegawai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.status_pegawai_id_seq', 2, true);


--
-- Name: tingkat_kebutuhan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tingkat_kebutuhan_id_seq', 1, false);


--
-- Name: tingkat_prestasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tingkat_prestasi_id_seq', 5, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: guru guru_nip_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru
    ADD CONSTRAINT guru_nip_unique UNIQUE (nip);


--
-- Name: guru guru_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru
    ADD CONSTRAINT guru_pkey PRIMARY KEY (id);


--
-- Name: guru_prestasi guru_prestasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru_prestasi
    ADD CONSTRAINT guru_prestasi_pkey PRIMARY KEY (id);


--
-- Name: hak_akses hak_akses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.hak_akses
    ADD CONSTRAINT hak_akses_pkey PRIMARY KEY (id);


--
-- Name: jabatan jabatan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_pkey PRIMARY KEY (id);


--
-- Name: jam jam_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jam
    ADD CONSTRAINT jam_pkey PRIMARY KEY (id);


--
-- Name: jenjang jenjang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenjang
    ADD CONSTRAINT jenjang_pkey PRIMARY KEY (id);


--
-- Name: jurusan jurusan_nama_jurusan_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jurusan
    ADD CONSTRAINT jurusan_nama_jurusan_unique UNIQUE (nama_jurusan);


--
-- Name: jurusan jurusan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jurusan
    ADD CONSTRAINT jurusan_pkey PRIMARY KEY (id);


--
-- Name: kategori_sekolah kategori_sekolah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori_sekolah
    ADD CONSTRAINT kategori_sekolah_pkey PRIMARY KEY (id);


--
-- Name: kecamatan kecamatan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kecamatan
    ADD CONSTRAINT kecamatan_pkey PRIMARY KEY (id);


--
-- Name: mapel mapel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mapel
    ADD CONSTRAINT mapel_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: old_user old_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.old_user
    ADD CONSTRAINT old_user_pkey PRIMARY KEY (id);


--
-- Name: pendidikan pendidikan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan
    ADD CONSTRAINT pendidikan_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: prestasis prestasis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestasis
    ADD CONSTRAINT prestasis_pkey PRIMARY KEY (id);


--
-- Name: ptk ptk_nip_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ptk
    ADD CONSTRAINT ptk_nip_unique UNIQUE (nip);


--
-- Name: ptk ptk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ptk
    ADD CONSTRAINT ptk_pkey PRIMARY KEY (id);


--
-- Name: rombel rombel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rombel
    ADD CONSTRAINT rombel_pkey PRIMARY KEY (id);


--
-- Name: ruangan ruangan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ruangan
    ADD CONSTRAINT ruangan_pkey PRIMARY KEY (id);


--
-- Name: sapras sapras_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sapras
    ADD CONSTRAINT sapras_pkey PRIMARY KEY (id);


--
-- Name: sekolah sekolah_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sekolah
    ADD CONSTRAINT sekolah_email_unique UNIQUE (email);


--
-- Name: sekolah sekolah_npsn_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sekolah
    ADD CONSTRAINT sekolah_npsn_unique UNIQUE (npsn);


--
-- Name: sekolah sekolah_nss_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sekolah
    ADD CONSTRAINT sekolah_nss_unique UNIQUE (nss);


--
-- Name: sekolah sekolah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sekolah
    ADD CONSTRAINT sekolah_pkey PRIMARY KEY (id);


--
-- Name: siswa siswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_pkey PRIMARY KEY (id);


--
-- Name: siswa_prestasi siswa_prestasi_nis_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_prestasi
    ADD CONSTRAINT siswa_prestasi_nis_unique UNIQUE (nis);


--
-- Name: siswa_prestasi siswa_prestasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_prestasi
    ADD CONSTRAINT siswa_prestasi_pkey PRIMARY KEY (id);


--
-- Name: status_pegawai status_pegawai_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.status_pegawai
    ADD CONSTRAINT status_pegawai_pkey PRIMARY KEY (id);


--
-- Name: tingkat_kebutuhan tingkat_kebutuhan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tingkat_kebutuhan
    ADD CONSTRAINT tingkat_kebutuhan_pkey PRIMARY KEY (id);


--
-- Name: tingkat_prestasi tingkat_prestasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tingkat_prestasi
    ADD CONSTRAINT tingkat_prestasi_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- PostgreSQL database dump complete
--

\unrestrict yMugrfGwXzRlNtRnxpA0savO4UuIfyJaf03dN8LzrHzcGxEc5m2VWcqnmuOOFlf

