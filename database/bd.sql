PGDMP         '             
    w            dotclass    12.0    12.0 �               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                        0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            !           1262    17191    dotclass    DATABASE     �   CREATE DATABASE dotclass WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Mexico.1252' LC_CTYPE = 'Spanish_Mexico.1252';
    DROP DATABASE dotclass;
                postgres    false            �            1255    18042 ,   fn_porcentajecurso_usuario(integer, integer)    FUNCTION     w  CREATE FUNCTION public.fn_porcentajecurso_usuario(id_curso integer, id_usuario integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
 DECLARE
 	porc numeric;
 BEGIN
 	SELECT	ROUND (((EXTRACT(HOUR FROM SUM(vis.tiempo)) * 3600 + EXTRACT(MINUTE FROM SUM(vis.tiempo)) * 60 + EXTRACT(SECOND FROM SUM(vis.tiempo)))/(EXTRACT(HOUR FROM cur.duracion) * 3600 + EXTRACT(MINUTE FROM cur.duracion) * 60 + EXTRACT(SECOND FROM cur.duracion)))*100)	INTO porc		
	FROM	usuario usu INNER JOIN seguimiento seg ON usu.id = seg.usuario_id
			INNER JOIN curso cur ON seg.curso_id = cur.id
			INNER JOIN seccion sec ON cur.id = sec.curso_id
			INNER JOIN clase cla ON sec.id = cla.seccion_id
			INNER JOIN actividad_curso atc on cla.id = atc.clase_id
			INNER JOIN visita vis ON atc.visita_id = vis.id
	WHERE	usu.id = id_usuario AND cur.id = id_curso
	GROUP BY cur.id;
	RETURN porc;
 END;
 $$;
 W   DROP FUNCTION public.fn_porcentajecurso_usuario(id_curso integer, id_usuario integer);
       public          postgres    false            �            1255    18034    fn_tg_actualizarduracion()    FUNCTION     |  CREATE FUNCTION public.fn_tg_actualizarduracion() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    _curso_id INT;
    _duracion TIME;
BEGIN
    SELECT curso.id
    INTO _curso_id
    FROM curso
             INNER JOIN seccion s2 ON curso.id = s2.curso_id
    WHERE s2.id = new.seccion_id
       OR s2.id = old.seccion_id;

    SELECT SUM(c.duracion)::TIME
    INTO _duracion
    FROM curso
             INNER JOIN seccion s ON curso.id = s.curso_id
             INNER JOIN clase c on s.id = c.seccion_id
    WHERE curso.id = _curso_id;

    UPDATE curso SET duracion = _duracion WHERE id = _curso_id;
    RETURN new;
END;
$$;
 1   DROP FUNCTION public.fn_tg_actualizarduracion();
       public          postgres    false            �            1255    18045 #   fn_tg_actualizarnumerocomentarios()    FUNCTION     u  CREATE FUNCTION public.fn_tg_actualizarnumerocomentarios() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    _id_comentario INT;
BEGIN
	SELECT comentario.comentario_padre_id INTO _id_comentario
    FROM comentario
    WHERE comentario.id = new.id;
	
	UPDATE comentario SET numero_comentarios = numero_comentarios + 1 WHERE id = _id_comentario; 
END;
$$;
 :   DROP FUNCTION public.fn_tg_actualizarnumerocomentarios();
       public          postgres    false            �            1255    18043    fn_tg_actualizarsusbcriptores()    FUNCTION        CREATE FUNCTION public.fn_tg_actualizarsusbcriptores() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    _id_curso INT;
    _cant INT;
BEGIN
    SELECT curso_id INTO _id_curso
    FROM seguimiento
    WHERE seguimiento.curso_id = new.curso_id OR seguimiento.curso_id = old.curso_id;

    SELECT COUNT(usuario_id) INTO _cant
    FROM seguimiento
    WHERE seguimiento.curso_id = _id_curso;

    UPDATE curso SET numero_subscriptores = _cant WHERE id = _id_curso;
    RETURN new;
END;
$$;
 6   DROP FUNCTION public.fn_tg_actualizarsusbcriptores();
       public          postgres    false            �            1259    17956    actividad_curso    TABLE       CREATE TABLE public.actividad_curso (
    usuario_id integer NOT NULL,
    clase_id integer NOT NULL,
    visita_id integer,
    marcador_id integer,
    aporte_id integer,
    comentario_id integer,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
 #   DROP TABLE public.actividad_curso;
       public         heap    postgres    false            �            1259    17954    actividad_curso_usuario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.actividad_curso_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.actividad_curso_usuario_id_seq;
       public          postgres    false    240            "           0    0    actividad_curso_usuario_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.actividad_curso_usuario_id_seq OWNED BY public.actividad_curso.usuario_id;
          public          postgres    false    239            �            1259    17991    actividad_examen    TABLE     �   CREATE TABLE public.actividad_examen (
    usuario_id integer NOT NULL,
    pregunta_id integer NOT NULL,
    nota integer NOT NULL
);
 $   DROP TABLE public.actividad_examen;
       public         heap    postgres    false            �            1259    17927    alternativa    TABLE     �   CREATE TABLE public.alternativa (
    id integer NOT NULL,
    pregunta_id integer NOT NULL,
    numero integer NOT NULL,
    contenido character varying(180) NOT NULL,
    respuesta boolean NOT NULL
);
    DROP TABLE public.alternativa;
       public         heap    postgres    false            �            1259    17925    alternativa_id_seq    SEQUENCE     �   CREATE SEQUENCE public.alternativa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.alternativa_id_seq;
       public          postgres    false    236            #           0    0    alternativa_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.alternativa_id_seq OWNED BY public.alternativa.id;
          public          postgres    false    235            �            1259    17707    aporte    TABLE     �   CREATE TABLE public.aporte (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    contenido text NOT NULL,
    numero_likes integer DEFAULT 0 NOT NULL,
    numero_comentarios integer DEFAULT 0 NOT NULL
);
    DROP TABLE public.aporte;
       public         heap    postgres    false            �            1259    17705    aporte_id_seq    SEQUENCE     �   CREATE SEQUENCE public.aporte_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.aporte_id_seq;
       public          postgres    false    209            $           0    0    aporte_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.aporte_id_seq OWNED BY public.aporte.id;
          public          postgres    false    208            �            1259    17808    blog    TABLE     �   CREATE TABLE public.blog (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    contenido text NOT NULL,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.blog;
       public         heap    postgres    false            �            1259    17806    blog_id_seq    SEQUENCE     �   CREATE SEQUENCE public.blog_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.blog_id_seq;
       public          postgres    false    223            %           0    0    blog_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.blog_id_seq OWNED BY public.blog.id;
          public          postgres    false    222            �            1259    17823    bonificacion    TABLE     �   CREATE TABLE public.bonificacion (
    usuario_emisor_id integer NOT NULL,
    usuario_receptor_id integer NOT NULL,
    tipo_suscripcion_id integer NOT NULL,
    cantidad money,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
     DROP TABLE public.bonificacion;
       public         heap    postgres    false            �            1259    17728 	   categoria    TABLE     �   CREATE TABLE public.categoria (
    id integer NOT NULL,
    nombre character varying(45) NOT NULL,
    descripcion text NOT NULL,
    logo character varying(100) NOT NULL
);
    DROP TABLE public.categoria;
       public         heap    postgres    false            �            1259    17726    categoria_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categoria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.categoria_id_seq;
       public          postgres    false    213            &           0    0    categoria_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.categoria_id_seq OWNED BY public.categoria.id;
          public          postgres    false    212            �            1259    17691    ciudad    TABLE     c   CREATE TABLE public.ciudad (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL
);
    DROP TABLE public.ciudad;
       public         heap    postgres    false            �            1259    17689    ciudad_id_seq    SEQUENCE     �   CREATE SEQUENCE public.ciudad_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.ciudad_id_seq;
       public          postgres    false    205            '           0    0    ciudad_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.ciudad_id_seq OWNED BY public.ciudad.id;
          public          postgres    false    204            �            1259    17883    clase    TABLE     �  CREATE TABLE public.clase (
    id integer NOT NULL,
    seccion_id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    duracion time without time zone DEFAULT '00:00:00'::time without time zone NOT NULL,
    contenido_video character varying(180),
    contenido_texto text,
    fecha_subida timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    descripcion text
);
    DROP TABLE public.clase;
       public         heap    postgres    false            �            1259    17881    clase_id_seq    SEQUENCE     �   CREATE SEQUENCE public.clase_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.clase_id_seq;
       public          postgres    false    230            (           0    0    clase_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.clase_id_seq OWNED BY public.clase.id;
          public          postgres    false    229            �            1259    17940 
   comentario    TABLE     /  CREATE TABLE public.comentario (
    id integer NOT NULL,
    comentario_padre_id integer,
    contenido character varying(150) NOT NULL,
    numero_likes integer DEFAULT 0 NOT NULL,
    numero_comentarios integer DEFAULT 0 NOT NULL,
    pregunta boolean DEFAULT false NOT NULL,
    resuelto boolean
);
    DROP TABLE public.comentario;
       public         heap    postgres    false            �            1259    17938    comentario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.comentario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.comentario_id_seq;
       public          postgres    false    238            )           0    0    comentario_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.comentario_id_seq OWNED BY public.comentario.id;
          public          postgres    false    237            �            1259    17772    conocimiento    TABLE       CREATE TABLE public.conocimiento (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    grado_academico character varying(40),
    lugar_estudio character varying(80),
    anio integer NOT NULL,
    pais_id integer NOT NULL,
    usuario_id integer NOT NULL
);
     DROP TABLE public.conocimiento;
       public         heap    postgres    false            �            1259    17770    conocimiento_id_seq    SEQUENCE     �   CREATE SEQUENCE public.conocimiento_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.conocimiento_id_seq;
       public          postgres    false    219            *           0    0    conocimiento_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.conocimiento_id_seq OWNED BY public.conocimiento.id;
          public          postgres    false    218            �            1259    17844    curso    TABLE     Y  CREATE TABLE public.curso (
    id integer NOT NULL,
    categoria_id integer NOT NULL,
    titulo character varying(45) NOT NULL,
    descripcion text NOT NULL,
    logo character varying(70) NOT NULL,
    duracion time without time zone DEFAULT '00:00:00'::time without time zone NOT NULL,
    numero_subscriptores integer DEFAULT 0 NOT NULL,
    valoracion integer DEFAULT 0 NOT NULL,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    fecha_ultima_actualizacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    usuario_id integer NOT NULL
);
    DROP TABLE public.curso;
       public         heap    postgres    false            �            1259    17842    curso_id_seq    SEQUENCE     �   CREATE SEQUENCE public.curso_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.curso_id_seq;
       public          postgres    false    226            +           0    0    curso_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.curso_id_seq OWNED BY public.curso.id;
          public          postgres    false    225            �            1259    17901    examen    TABLE     r   CREATE TABLE public.examen (
    id integer NOT NULL,
    curso_id integer NOT NULL,
    mensaje text NOT NULL
);
    DROP TABLE public.examen;
       public         heap    postgres    false            �            1259    17899    examen_id_seq    SEQUENCE     �   CREATE SEQUENCE public.examen_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.examen_id_seq;
       public          postgres    false    232            ,           0    0    examen_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.examen_id_seq OWNED BY public.examen.id;
          public          postgres    false    231            �            1259    17790    experiencia_laboral    TABLE       CREATE TABLE public.experiencia_laboral (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    lugar character varying(80) NOT NULL,
    fecha_inicio date NOT NULL,
    fecha_fin date,
    pais_id integer NOT NULL,
    usuario_id integer NOT NULL
);
 '   DROP TABLE public.experiencia_laboral;
       public         heap    postgres    false            �            1259    17788    experiencia_laboral_id_seq    SEQUENCE     �   CREATE SEQUENCE public.experiencia_laboral_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.experiencia_laboral_id_seq;
       public          postgres    false    221            -           0    0    experiencia_laboral_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.experiencia_laboral_id_seq OWNED BY public.experiencia_laboral.id;
          public          postgres    false    220            �            1259    17720    marcador    TABLE     �   CREATE TABLE public.marcador (
    id integer NOT NULL,
    titulo character varying(45) NOT NULL,
    tiempo character varying(45) NOT NULL
);
    DROP TABLE public.marcador;
       public         heap    postgres    false            �            1259    17718    marcador_id_seq    SEQUENCE     �   CREATE SEQUENCE public.marcador_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.marcador_id_seq;
       public          postgres    false    211            .           0    0    marcador_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.marcador_id_seq OWNED BY public.marcador.id;
          public          postgres    false    210            �            1259    17683    pais    TABLE     a   CREATE TABLE public.pais (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL
);
    DROP TABLE public.pais;
       public         heap    postgres    false            �            1259    17681    pais_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pais_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.pais_id_seq;
       public          postgres    false    203            /           0    0    pais_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.pais_id_seq OWNED BY public.pais.id;
          public          postgres    false    202            �            1259    17914    pregunta    TABLE     �   CREATE TABLE public.pregunta (
    id integer NOT NULL,
    examen_id integer NOT NULL,
    numero smallint NOT NULL,
    titulo character varying(150) NOT NULL
);
    DROP TABLE public.pregunta;
       public         heap    postgres    false            �            1259    17912    pregunta_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pregunta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.pregunta_id_seq;
       public          postgres    false    234            0           0    0    pregunta_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.pregunta_id_seq OWNED BY public.pregunta.id;
          public          postgres    false    233            �            1259    18004    prerrequisito    TABLE     r   CREATE TABLE public.prerrequisito (
    curso_id integer NOT NULL,
    curso_prerrequisito_id integer NOT NULL
);
 !   DROP TABLE public.prerrequisito;
       public         heap    postgres    false            �            1259    17870    seccion    TABLE     �   CREATE TABLE public.seccion (
    id integer NOT NULL,
    curso_id integer NOT NULL,
    titulo character varying(45) NOT NULL
);
    DROP TABLE public.seccion;
       public         heap    postgres    false            �            1259    17868    seccion_id_seq    SEQUENCE     �   CREATE SEQUENCE public.seccion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.seccion_id_seq;
       public          postgres    false    228            1           0    0    seccion_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.seccion_id_seq OWNED BY public.seccion.id;
          public          postgres    false    227            �            1259    18017    seguimiento    TABLE     d   CREATE TABLE public.seguimiento (
    usuario_id integer NOT NULL,
    curso_id integer NOT NULL
);
    DROP TABLE public.seguimiento;
       public         heap    postgres    false            �            1259    17736    tipo_suscripcion    TABLE     m   CREATE TABLE public.tipo_suscripcion (
    id integer NOT NULL,
    nombre character varying(45) NOT NULL
);
 $   DROP TABLE public.tipo_suscripcion;
       public         heap    postgres    false            �            1259    17734    tipo_suscripcion_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_suscripcion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tipo_suscripcion_id_seq;
       public          postgres    false    215            2           0    0    tipo_suscripcion_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tipo_suscripcion_id_seq OWNED BY public.tipo_suscripcion.id;
          public          postgres    false    214            �            1259    17744    usuario    TABLE     �  CREATE TABLE public.usuario (
    id integer NOT NULL,
    nickname character varying(30) NOT NULL,
    password character varying(42) NOT NULL,
    nombres character varying(60) NOT NULL,
    apellidos character varying(60) NOT NULL,
    email character varying(80) NOT NULL,
    fecha_nacimiento date NOT NULL,
    descripcion character varying,
    numero_seguidores integer DEFAULT 0 NOT NULL,
    pregunta_seguridad character varying(255) NOT NULL,
    respuesta_seguridad character varying(50) NOT NULL,
    foto character varying(100),
    pais_id integer NOT NULL,
    ciudad_id integer NOT NULL,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    estado boolean DEFAULT true NOT NULL
);
    DROP TABLE public.usuario;
       public         heap    postgres    false            �            1259    17742    usuario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.usuario_id_seq;
       public          postgres    false    217            3           0    0    usuario_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;
          public          postgres    false    216            �            1259    17699    visita    TABLE     d   CREATE TABLE public.visita (
    id integer NOT NULL,
    tiempo time without time zone NOT NULL
);
    DROP TABLE public.visita;
       public         heap    postgres    false            �            1259    17697    visita_id_seq    SEQUENCE     �   CREATE SEQUENCE public.visita_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.visita_id_seq;
       public          postgres    false    207            4           0    0    visita_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.visita_id_seq OWNED BY public.visita.id;
          public          postgres    false    206            )           2604    17959    actividad_curso usuario_id    DEFAULT     �   ALTER TABLE ONLY public.actividad_curso ALTER COLUMN usuario_id SET DEFAULT nextval('public.actividad_curso_usuario_id_seq'::regclass);
 I   ALTER TABLE public.actividad_curso ALTER COLUMN usuario_id DROP DEFAULT;
       public          postgres    false    239    240    240            $           2604    17930    alternativa id    DEFAULT     p   ALTER TABLE ONLY public.alternativa ALTER COLUMN id SET DEFAULT nextval('public.alternativa_id_seq'::regclass);
 =   ALTER TABLE public.alternativa ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    235    236    236            	           2604    17710 	   aporte id    DEFAULT     f   ALTER TABLE ONLY public.aporte ALTER COLUMN id SET DEFAULT nextval('public.aporte_id_seq'::regclass);
 8   ALTER TABLE public.aporte ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    208    209    209                       2604    17811    blog id    DEFAULT     b   ALTER TABLE ONLY public.blog ALTER COLUMN id SET DEFAULT nextval('public.blog_id_seq'::regclass);
 6   ALTER TABLE public.blog ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    223    223                       2604    17731    categoria id    DEFAULT     l   ALTER TABLE ONLY public.categoria ALTER COLUMN id SET DEFAULT nextval('public.categoria_id_seq'::regclass);
 ;   ALTER TABLE public.categoria ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    213    212    213                       2604    17694 	   ciudad id    DEFAULT     f   ALTER TABLE ONLY public.ciudad ALTER COLUMN id SET DEFAULT nextval('public.ciudad_id_seq'::regclass);
 8   ALTER TABLE public.ciudad ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    204    205    205                       2604    17886    clase id    DEFAULT     d   ALTER TABLE ONLY public.clase ALTER COLUMN id SET DEFAULT nextval('public.clase_id_seq'::regclass);
 7   ALTER TABLE public.clase ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    230    229    230            %           2604    17943    comentario id    DEFAULT     n   ALTER TABLE ONLY public.comentario ALTER COLUMN id SET DEFAULT nextval('public.comentario_id_seq'::regclass);
 <   ALTER TABLE public.comentario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    238    237    238                       2604    17775    conocimiento id    DEFAULT     r   ALTER TABLE ONLY public.conocimiento ALTER COLUMN id SET DEFAULT nextval('public.conocimiento_id_seq'::regclass);
 >   ALTER TABLE public.conocimiento ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218    219                       2604    17847    curso id    DEFAULT     d   ALTER TABLE ONLY public.curso ALTER COLUMN id SET DEFAULT nextval('public.curso_id_seq'::regclass);
 7   ALTER TABLE public.curso ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    225    226            "           2604    17904 	   examen id    DEFAULT     f   ALTER TABLE ONLY public.examen ALTER COLUMN id SET DEFAULT nextval('public.examen_id_seq'::regclass);
 8   ALTER TABLE public.examen ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    232    232                       2604    17793    experiencia_laboral id    DEFAULT     �   ALTER TABLE ONLY public.experiencia_laboral ALTER COLUMN id SET DEFAULT nextval('public.experiencia_laboral_id_seq'::regclass);
 E   ALTER TABLE public.experiencia_laboral ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    220    221                       2604    17723    marcador id    DEFAULT     j   ALTER TABLE ONLY public.marcador ALTER COLUMN id SET DEFAULT nextval('public.marcador_id_seq'::regclass);
 :   ALTER TABLE public.marcador ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    210    211                       2604    17686    pais id    DEFAULT     b   ALTER TABLE ONLY public.pais ALTER COLUMN id SET DEFAULT nextval('public.pais_id_seq'::regclass);
 6   ALTER TABLE public.pais ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    202    203    203            #           2604    17917    pregunta id    DEFAULT     j   ALTER TABLE ONLY public.pregunta ALTER COLUMN id SET DEFAULT nextval('public.pregunta_id_seq'::regclass);
 :   ALTER TABLE public.pregunta ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    233    234    234                       2604    17873 
   seccion id    DEFAULT     h   ALTER TABLE ONLY public.seccion ALTER COLUMN id SET DEFAULT nextval('public.seccion_id_seq'::regclass);
 9   ALTER TABLE public.seccion ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    228    228                       2604    17739    tipo_suscripcion id    DEFAULT     z   ALTER TABLE ONLY public.tipo_suscripcion ALTER COLUMN id SET DEFAULT nextval('public.tipo_suscripcion_id_seq'::regclass);
 B   ALTER TABLE public.tipo_suscripcion ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214    215                       2604    17747 
   usuario id    DEFAULT     h   ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);
 9   ALTER TABLE public.usuario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    217    217                       2604    17702 	   visita id    DEFAULT     f   ALTER TABLE ONLY public.visita ALTER COLUMN id SET DEFAULT nextval('public.visita_id_seq'::regclass);
 8   ALTER TABLE public.visita ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    206    207    207                      0    17956    actividad_curso 
   TABLE DATA           x   COPY public.actividad_curso (usuario_id, clase_id, visita_id, marcador_id, aporte_id, comentario_id, fecha) FROM stdin;
    public          postgres    false    240   K�                 0    17991    actividad_examen 
   TABLE DATA           I   COPY public.actividad_examen (usuario_id, pregunta_id, nota) FROM stdin;
    public          postgres    false    241   h�                 0    17927    alternativa 
   TABLE DATA           T   COPY public.alternativa (id, pregunta_id, numero, contenido, respuesta) FROM stdin;
    public          postgres    false    236   ��       �          0    17707    aporte 
   TABLE DATA           Y   COPY public.aporte (id, titulo, contenido, numero_likes, numero_comentarios) FROM stdin;
    public          postgres    false    209   ��                 0    17808    blog 
   TABLE DATA           Q   COPY public.blog (id, usuario_id, titulo, contenido, fecha_creacion) FROM stdin;
    public          postgres    false    223   �                 0    17823    bonificacion 
   TABLE DATA           t   COPY public.bonificacion (usuario_emisor_id, usuario_receptor_id, tipo_suscripcion_id, cantidad, fecha) FROM stdin;
    public          postgres    false    224   8�       �          0    17728 	   categoria 
   TABLE DATA           B   COPY public.categoria (id, nombre, descripcion, logo) FROM stdin;
    public          postgres    false    213   U�       �          0    17691    ciudad 
   TABLE DATA           ,   COPY public.ciudad (id, nombre) FROM stdin;
    public          postgres    false    205   ��                 0    17883    clase 
   TABLE DATA           ~   COPY public.clase (id, seccion_id, titulo, duracion, contenido_video, contenido_texto, fecha_subida, descripcion) FROM stdin;
    public          postgres    false    230   ��                 0    17940 
   comentario 
   TABLE DATA           ~   COPY public.comentario (id, comentario_padre_id, contenido, numero_likes, numero_comentarios, pregunta, resuelto) FROM stdin;
    public          postgres    false    238   ��                 0    17772    conocimiento 
   TABLE DATA           m   COPY public.conocimiento (id, nombre, grado_academico, lugar_estudio, anio, pais_id, usuario_id) FROM stdin;
    public          postgres    false    219   ��       
          0    17844    curso 
   TABLE DATA           �   COPY public.curso (id, categoria_id, titulo, descripcion, logo, duracion, numero_subscriptores, valoracion, fecha_creacion, fecha_ultima_actualizacion, usuario_id) FROM stdin;
    public          postgres    false    226   i�                 0    17901    examen 
   TABLE DATA           7   COPY public.examen (id, curso_id, mensaje) FROM stdin;
    public          postgres    false    232   ]�                 0    17790    experiencia_laboral 
   TABLE DATA           n   COPY public.experiencia_laboral (id, nombre, lugar, fecha_inicio, fecha_fin, pais_id, usuario_id) FROM stdin;
    public          postgres    false    221   ��       �          0    17720    marcador 
   TABLE DATA           6   COPY public.marcador (id, titulo, tiempo) FROM stdin;
    public          postgres    false    211   K�       �          0    17683    pais 
   TABLE DATA           *   COPY public.pais (id, nombre) FROM stdin;
    public          postgres    false    203   h�                 0    17914    pregunta 
   TABLE DATA           A   COPY public.pregunta (id, examen_id, numero, titulo) FROM stdin;
    public          postgres    false    234   ��                 0    18004    prerrequisito 
   TABLE DATA           I   COPY public.prerrequisito (curso_id, curso_prerrequisito_id) FROM stdin;
    public          postgres    false    242   !�                 0    17870    seccion 
   TABLE DATA           7   COPY public.seccion (id, curso_id, titulo) FROM stdin;
    public          postgres    false    228   B�                 0    18017    seguimiento 
   TABLE DATA           ;   COPY public.seguimiento (usuario_id, curso_id) FROM stdin;
    public          postgres    false    243   ��       �          0    17736    tipo_suscripcion 
   TABLE DATA           6   COPY public.tipo_suscripcion (id, nombre) FROM stdin;
    public          postgres    false    215   ��                 0    17744    usuario 
   TABLE DATA           �   COPY public.usuario (id, nickname, password, nombres, apellidos, email, fecha_nacimiento, descripcion, numero_seguidores, pregunta_seguridad, respuesta_seguridad, foto, pais_id, ciudad_id, fecha_creacion, estado) FROM stdin;
    public          postgres    false    217   ��       �          0    17699    visita 
   TABLE DATA           ,   COPY public.visita (id, tiempo) FROM stdin;
    public          postgres    false    207   4�       5           0    0    actividad_curso_usuario_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.actividad_curso_usuario_id_seq', 1, false);
          public          postgres    false    239            6           0    0    alternativa_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.alternativa_id_seq', 16, true);
          public          postgres    false    235            7           0    0    aporte_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.aporte_id_seq', 1, false);
          public          postgres    false    208            8           0    0    blog_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.blog_id_seq', 1, false);
          public          postgres    false    222            9           0    0    categoria_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.categoria_id_seq', 6, true);
          public          postgres    false    212            :           0    0    ciudad_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.ciudad_id_seq', 1, true);
          public          postgres    false    204            ;           0    0    clase_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.clase_id_seq', 34, true);
          public          postgres    false    229            <           0    0    comentario_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.comentario_id_seq', 1, false);
          public          postgres    false    237            =           0    0    conocimiento_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.conocimiento_id_seq', 2, true);
          public          postgres    false    218            >           0    0    curso_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.curso_id_seq', 3, true);
          public          postgres    false    225            ?           0    0    examen_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.examen_id_seq', 1, true);
          public          postgres    false    231            @           0    0    experiencia_laboral_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.experiencia_laboral_id_seq', 5, true);
          public          postgres    false    220            A           0    0    marcador_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.marcador_id_seq', 1, false);
          public          postgres    false    210            B           0    0    pais_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.pais_id_seq', 1, true);
          public          postgres    false    202            C           0    0    pregunta_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.pregunta_id_seq', 4, true);
          public          postgres    false    233            D           0    0    seccion_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.seccion_id_seq', 7, true);
          public          postgres    false    227            E           0    0    tipo_suscripcion_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tipo_suscripcion_id_seq', 1, false);
          public          postgres    false    214            F           0    0    usuario_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.usuario_id_seq', 2, true);
          public          postgres    false    216            G           0    0    visita_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.visita_id_seq', 1, false);
          public          postgres    false    206            P           2606    17932    alternativa alternativa_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.alternativa
    ADD CONSTRAINT alternativa_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.alternativa DROP CONSTRAINT alternativa_pkey;
       public            postgres    false    236            2           2606    17717    aporte aporte_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.aporte
    ADD CONSTRAINT aporte_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.aporte DROP CONSTRAINT aporte_pkey;
       public            postgres    false    209            D           2606    17817    blog blog_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.blog
    ADD CONSTRAINT blog_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.blog DROP CONSTRAINT blog_pkey;
       public            postgres    false    223            6           2606    17733    categoria categoria_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.categoria DROP CONSTRAINT categoria_pkey;
       public            postgres    false    213            .           2606    17696    ciudad ciudad_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.ciudad
    ADD CONSTRAINT ciudad_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.ciudad DROP CONSTRAINT ciudad_pkey;
       public            postgres    false    205            J           2606    17893    clase clase_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.clase
    ADD CONSTRAINT clase_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.clase DROP CONSTRAINT clase_pkey;
       public            postgres    false    230            R           2606    17948    comentario comentario_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.comentario
    ADD CONSTRAINT comentario_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.comentario DROP CONSTRAINT comentario_pkey;
       public            postgres    false    238            @           2606    17777    conocimiento conocimiento_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.conocimiento
    ADD CONSTRAINT conocimiento_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.conocimiento DROP CONSTRAINT conocimiento_pkey;
       public            postgres    false    219            F           2606    17857    curso curso_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.curso
    ADD CONSTRAINT curso_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.curso DROP CONSTRAINT curso_pkey;
       public            postgres    false    226            L           2606    17906    examen examen_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.examen
    ADD CONSTRAINT examen_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.examen DROP CONSTRAINT examen_pkey;
       public            postgres    false    232            B           2606    17795 ,   experiencia_laboral experiencia_laboral_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.experiencia_laboral
    ADD CONSTRAINT experiencia_laboral_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.experiencia_laboral DROP CONSTRAINT experiencia_laboral_pkey;
       public            postgres    false    221            4           2606    17725    marcador marcador_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.marcador
    ADD CONSTRAINT marcador_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.marcador DROP CONSTRAINT marcador_pkey;
       public            postgres    false    211            ,           2606    17688    pais pais_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.pais
    ADD CONSTRAINT pais_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.pais DROP CONSTRAINT pais_pkey;
       public            postgres    false    203            N           2606    17919    pregunta pregunta_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.pregunta
    ADD CONSTRAINT pregunta_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.pregunta DROP CONSTRAINT pregunta_pkey;
       public            postgres    false    234            H           2606    17875    seccion seccion_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.seccion
    ADD CONSTRAINT seccion_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.seccion DROP CONSTRAINT seccion_pkey;
       public            postgres    false    228            8           2606    17741 &   tipo_suscripcion tipo_suscripcion_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.tipo_suscripcion
    ADD CONSTRAINT tipo_suscripcion_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.tipo_suscripcion DROP CONSTRAINT tipo_suscripcion_pkey;
       public            postgres    false    215            :           2606    17759    usuario usuario_email_key 
   CONSTRAINT     U   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_email_key UNIQUE (email);
 C   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_email_key;
       public            postgres    false    217            <           2606    17757    usuario usuario_nickname_key 
   CONSTRAINT     [   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_nickname_key UNIQUE (nickname);
 F   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_nickname_key;
       public            postgres    false    217            >           2606    17755    usuario usuario_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    217            0           2606    17704    visita visita_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.visita
    ADD CONSTRAINT visita_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.visita DROP CONSTRAINT visita_pkey;
       public            postgres    false    207            q           2620    18035    clase tg_actualizarduracion    TRIGGER     �   CREATE TRIGGER tg_actualizarduracion AFTER INSERT OR DELETE OR UPDATE ON public.clase FOR EACH ROW EXECUTE FUNCTION public.fn_tg_actualizarduracion();
 4   DROP TRIGGER tg_actualizarduracion ON public.clase;
       public          postgres    false    244    230            r           2620    18046 )   comentario tg_actualizarnumerocomentarios    TRIGGER     �   CREATE TRIGGER tg_actualizarnumerocomentarios AFTER INSERT ON public.comentario FOR EACH ROW EXECUTE FUNCTION public.fn_tg_actualizarnumerocomentarios();
 B   DROP TRIGGER tg_actualizarnumerocomentarios ON public.comentario;
       public          postgres    false    247    238            s           2620    18044 &   seguimiento tg_actualizarsusbcriptores    TRIGGER     �   CREATE TRIGGER tg_actualizarsusbcriptores AFTER INSERT OR DELETE OR UPDATE ON public.seguimiento FOR EACH ROW EXECUTE FUNCTION public.fn_tg_actualizarsusbcriptores();
 ?   DROP TRIGGER tg_actualizarsusbcriptores ON public.seguimiento;
       public          postgres    false    246    243            i           2606    17981 .   actividad_curso actividad_curso_aporte_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_curso
    ADD CONSTRAINT actividad_curso_aporte_id_fkey FOREIGN KEY (aporte_id) REFERENCES public.aporte(id);
 X   ALTER TABLE ONLY public.actividad_curso DROP CONSTRAINT actividad_curso_aporte_id_fkey;
       public          postgres    false    2866    240    209            f           2606    17966 -   actividad_curso actividad_curso_clase_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_curso
    ADD CONSTRAINT actividad_curso_clase_id_fkey FOREIGN KEY (clase_id) REFERENCES public.clase(id);
 W   ALTER TABLE ONLY public.actividad_curso DROP CONSTRAINT actividad_curso_clase_id_fkey;
       public          postgres    false    2890    240    230            j           2606    17986 2   actividad_curso actividad_curso_comentario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_curso
    ADD CONSTRAINT actividad_curso_comentario_id_fkey FOREIGN KEY (comentario_id) REFERENCES public.comentario(id);
 \   ALTER TABLE ONLY public.actividad_curso DROP CONSTRAINT actividad_curso_comentario_id_fkey;
       public          postgres    false    240    238    2898            h           2606    17976 0   actividad_curso actividad_curso_marcador_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_curso
    ADD CONSTRAINT actividad_curso_marcador_id_fkey FOREIGN KEY (marcador_id) REFERENCES public.marcador(id);
 Z   ALTER TABLE ONLY public.actividad_curso DROP CONSTRAINT actividad_curso_marcador_id_fkey;
       public          postgres    false    211    2868    240            e           2606    17961 /   actividad_curso actividad_curso_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_curso
    ADD CONSTRAINT actividad_curso_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 Y   ALTER TABLE ONLY public.actividad_curso DROP CONSTRAINT actividad_curso_usuario_id_fkey;
       public          postgres    false    2878    240    217            g           2606    17971 .   actividad_curso actividad_curso_visita_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_curso
    ADD CONSTRAINT actividad_curso_visita_id_fkey FOREIGN KEY (visita_id) REFERENCES public.visita(id);
 X   ALTER TABLE ONLY public.actividad_curso DROP CONSTRAINT actividad_curso_visita_id_fkey;
       public          postgres    false    2864    240    207            l           2606    17999 2   actividad_examen actividad_examen_pregunta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_examen
    ADD CONSTRAINT actividad_examen_pregunta_id_fkey FOREIGN KEY (pregunta_id) REFERENCES public.pregunta(id);
 \   ALTER TABLE ONLY public.actividad_examen DROP CONSTRAINT actividad_examen_pregunta_id_fkey;
       public          postgres    false    234    241    2894            k           2606    17994 1   actividad_examen actividad_examen_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.actividad_examen
    ADD CONSTRAINT actividad_examen_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 [   ALTER TABLE ONLY public.actividad_examen DROP CONSTRAINT actividad_examen_usuario_id_fkey;
       public          postgres    false    217    241    2878            c           2606    17933 (   alternativa alternativa_pregunta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.alternativa
    ADD CONSTRAINT alternativa_pregunta_id_fkey FOREIGN KEY (pregunta_id) REFERENCES public.pregunta(id);
 R   ALTER TABLE ONLY public.alternativa DROP CONSTRAINT alternativa_pregunta_id_fkey;
       public          postgres    false    234    2894    236            Y           2606    17818    blog blog_usuario_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.blog
    ADD CONSTRAINT blog_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 C   ALTER TABLE ONLY public.blog DROP CONSTRAINT blog_usuario_id_fkey;
       public          postgres    false    217    2878    223            \           2606    17837 2   bonificacion bonificacion_tipo_suscripcion_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.bonificacion
    ADD CONSTRAINT bonificacion_tipo_suscripcion_id_fkey FOREIGN KEY (tipo_suscripcion_id) REFERENCES public.tipo_suscripcion(id);
 \   ALTER TABLE ONLY public.bonificacion DROP CONSTRAINT bonificacion_tipo_suscripcion_id_fkey;
       public          postgres    false    224    215    2872            Z           2606    17827 0   bonificacion bonificacion_usuario_emisor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.bonificacion
    ADD CONSTRAINT bonificacion_usuario_emisor_id_fkey FOREIGN KEY (usuario_emisor_id) REFERENCES public.usuario(id);
 Z   ALTER TABLE ONLY public.bonificacion DROP CONSTRAINT bonificacion_usuario_emisor_id_fkey;
       public          postgres    false    2878    224    217            [           2606    17832 2   bonificacion bonificacion_usuario_receptor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.bonificacion
    ADD CONSTRAINT bonificacion_usuario_receptor_id_fkey FOREIGN KEY (usuario_receptor_id) REFERENCES public.usuario(id);
 \   ALTER TABLE ONLY public.bonificacion DROP CONSTRAINT bonificacion_usuario_receptor_id_fkey;
       public          postgres    false    2878    224    217            `           2606    17894    clase clase_seccion_id_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.clase
    ADD CONSTRAINT clase_seccion_id_fkey FOREIGN KEY (seccion_id) REFERENCES public.seccion(id);
 E   ALTER TABLE ONLY public.clase DROP CONSTRAINT clase_seccion_id_fkey;
       public          postgres    false    230    228    2888            d           2606    17949 .   comentario comentario_comentario_padre_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.comentario
    ADD CONSTRAINT comentario_comentario_padre_id_fkey FOREIGN KEY (comentario_padre_id) REFERENCES public.comentario(id);
 X   ALTER TABLE ONLY public.comentario DROP CONSTRAINT comentario_comentario_padre_id_fkey;
       public          postgres    false    2898    238    238            U           2606    17778 &   conocimiento conocimiento_pais_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.conocimiento
    ADD CONSTRAINT conocimiento_pais_id_fkey FOREIGN KEY (pais_id) REFERENCES public.pais(id);
 P   ALTER TABLE ONLY public.conocimiento DROP CONSTRAINT conocimiento_pais_id_fkey;
       public          postgres    false    203    2860    219            V           2606    17783 )   conocimiento conocimiento_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.conocimiento
    ADD CONSTRAINT conocimiento_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 S   ALTER TABLE ONLY public.conocimiento DROP CONSTRAINT conocimiento_usuario_id_fkey;
       public          postgres    false    2878    219    217            ]           2606    17858    curso curso_categoria_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.curso
    ADD CONSTRAINT curso_categoria_id_fkey FOREIGN KEY (categoria_id) REFERENCES public.categoria(id);
 G   ALTER TABLE ONLY public.curso DROP CONSTRAINT curso_categoria_id_fkey;
       public          postgres    false    226    213    2870            ^           2606    17863    curso curso_usuario_id_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.curso
    ADD CONSTRAINT curso_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 E   ALTER TABLE ONLY public.curso DROP CONSTRAINT curso_usuario_id_fkey;
       public          postgres    false    2878    217    226            a           2606    17907    examen examen_curso_id_fkey    FK CONSTRAINT     {   ALTER TABLE ONLY public.examen
    ADD CONSTRAINT examen_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES public.curso(id);
 E   ALTER TABLE ONLY public.examen DROP CONSTRAINT examen_curso_id_fkey;
       public          postgres    false    232    2886    226            W           2606    17796 4   experiencia_laboral experiencia_laboral_pais_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.experiencia_laboral
    ADD CONSTRAINT experiencia_laboral_pais_id_fkey FOREIGN KEY (pais_id) REFERENCES public.pais(id);
 ^   ALTER TABLE ONLY public.experiencia_laboral DROP CONSTRAINT experiencia_laboral_pais_id_fkey;
       public          postgres    false    2860    221    203            X           2606    17801 7   experiencia_laboral experiencia_laboral_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.experiencia_laboral
    ADD CONSTRAINT experiencia_laboral_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 a   ALTER TABLE ONLY public.experiencia_laboral DROP CONSTRAINT experiencia_laboral_usuario_id_fkey;
       public          postgres    false    221    217    2878            b           2606    17920     pregunta pregunta_examen_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pregunta
    ADD CONSTRAINT pregunta_examen_id_fkey FOREIGN KEY (examen_id) REFERENCES public.examen(id);
 J   ALTER TABLE ONLY public.pregunta DROP CONSTRAINT pregunta_examen_id_fkey;
       public          postgres    false    234    232    2892            m           2606    18007 )   prerrequisito prerrequisito_curso_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prerrequisito
    ADD CONSTRAINT prerrequisito_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES public.curso(id);
 S   ALTER TABLE ONLY public.prerrequisito DROP CONSTRAINT prerrequisito_curso_id_fkey;
       public          postgres    false    226    242    2886            n           2606    18012 7   prerrequisito prerrequisito_curso_prerrequisito_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prerrequisito
    ADD CONSTRAINT prerrequisito_curso_prerrequisito_id_fkey FOREIGN KEY (curso_prerrequisito_id) REFERENCES public.curso(id);
 a   ALTER TABLE ONLY public.prerrequisito DROP CONSTRAINT prerrequisito_curso_prerrequisito_id_fkey;
       public          postgres    false    242    226    2886            _           2606    17876    seccion seccion_curso_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.seccion
    ADD CONSTRAINT seccion_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES public.curso(id);
 G   ALTER TABLE ONLY public.seccion DROP CONSTRAINT seccion_curso_id_fkey;
       public          postgres    false    2886    226    228            p           2606    18025 %   seguimiento seguimiento_curso_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.seguimiento
    ADD CONSTRAINT seguimiento_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES public.curso(id);
 O   ALTER TABLE ONLY public.seguimiento DROP CONSTRAINT seguimiento_curso_id_fkey;
       public          postgres    false    2886    243    226            o           2606    18020 '   seguimiento seguimiento_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.seguimiento
    ADD CONSTRAINT seguimiento_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);
 Q   ALTER TABLE ONLY public.seguimiento DROP CONSTRAINT seguimiento_usuario_id_fkey;
       public          postgres    false    217    2878    243            T           2606    17765    usuario usuario_ciudad_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_ciudad_id_fkey FOREIGN KEY (ciudad_id) REFERENCES public.ciudad(id);
 H   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_ciudad_id_fkey;
       public          postgres    false    2862    205    217            S           2606    17760    usuario usuario_pais_id_fkey    FK CONSTRAINT     z   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pais_id_fkey FOREIGN KEY (pais_id) REFERENCES public.pais(id);
 F   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pais_id_fkey;
       public          postgres    false    2860    217    203                  x������ � �            x������ � �         i  x�m�=R�@���)4�;?�h(�@I��rذ^�&�:�)R��R~��g\����=iKW���`����͵E�ju���WA/�T�~8D�������(��5eL�5Q��쩱v�M]�ͭגX��jf0YP��YPq�j��a��aP�7��YU��Z�Ƌe��ӻ�����a��j�{7��R���E�7*W���B��ؠ'�|�ځ#m-�1���	(�#nl����{��w����,�l��M=q��`RB�Y�,�S;+�Ӱ�:�%��A���j�}6�D��ɈFˊ�r�Kee[Sz�N�>l��cƭO0j|>;_���O5h��|F6�O��m��9�o�r]�\#�H      �      x������ � �            x������ � �            x������ � �      �   p  x�MR�r�@�O_��p&~���q�΅5��a�4�(��7��T�����V�	b���%��O&��!ĵh��0ln��*��~_;�a��J��!_����O��*y��k��)��t��*a;IG�`T4��`0=$�X訠����` )��HU��X���#xP�L�׬> ��j#d�(yo@C����~E.�B�F��Gr{��o���{�,hӹ̂���B常�	�v^�f�o3?��y��[g�Y�g>Ԡ7�,��#�1U���:�Y��������W���bj�↋���HQ4i?���zn�������@B [`9��O��8P��^��Ge�����3�A�|�����Y���/�o7��_&Oڄ      �      x�3�t��L�I������� '4         �  x���M��H���u����G?�lI3ӎ��ݚ�7%H��
\�b����kA�W��V��CB���2_f�9�y�2#���e^:�qy����\�˗�8Ǘ�q�.nO|�sV�(�dbWVZĕ�Z/�<X;������eEJ�J�$g�[)+t~�����]���n�I�2�9ħ����U� rG�Ӫg�Ŕ�~Vy��Q�#)�Q�c�APיs�w�ԧ�[3�u��A�R�΍t�e8-�mf�"r�3����yb�x2�ւ}#M*����"�15�!cב��/R�/���	"~# Ν�s���HP�#�d��/t�`>�"?����J4Fj����}uX�`U	"2�ʚTV��I�[��Y�� ȍ��c�TM���h�;a�Χօq������/�[4����
9,�<��ή�F�@��%fXb�����1��~��]�:ޟ�f��ρ_���h�*M�Bp��C�]�X7����,��x؝��#,�����T�I���`��ׄR���Φ���"�湠u�'b�V���;<{9���D*���8�%��1�)���J��m�>�_�mE�h��e<,�����g7+=��t~��5*j��Grܭ�c�-�ޔi��߬�}=F��H�w�`�av�1vzɨ�y;��\ӱ�������"Tz�7c�#U(�#����?�S�M��>z�ܙ;��`_+3Dڛwx#��%,@x����yt��6�K �E�;�2��u]��^b�%g��إ��5ŵ.���Gq:� z n1D��2EJ��{�9쥾� %�(�m��L����m���W��Ӻ���l �?�b�7QoQ$����;�����W�N��q�P��$ß�����+�0�>��f+��XO�	i�\+��b8)��Z<۾-.��g�n�4��הm�o��{M��0L�B&�#;
V����a��{-�h���D'��-����t2����y            x������ � �         n   x�3���KO��L-:�6Q!%U!8��$57�X�R�9?���$19���<N���Լ��Ĕ|��`�N#CsNCNC.#N���̼Ԣ|N�̼�Ҽ|N�L����D���=... �<!      
   �  x����n�0��ާ� Q�(�m�"Ab9�2q�]/�l���M�8 !/��l@��R�8��7���KU���?���=]��+um�������7���p0O�$�#�I��q��E����K�N�|�	;���Kڏ?ip��÷�$��#ۻ$-i�Hb�C��T���1u��1��׫���Y֪��JmԲ�_uU�t�B���zM����ڮ+U/Vp�IX�����-\Y�	�/,��[�X�[��=��t0l�fm���AI�A+qR���8���:�w=N�,D9& ,�ZN~"8���f�EI�X�wv��?�Q�VW�  f�b��՛���M2d�bɊ;|ʶ�%8`���	P+�*����c&Vd"���.�'!�c�`o[�����ɷx�������)i�	���3_�4u�!�]3��\_^�|7裟�-���ͽo�/N`13}��\l73��3�ޖ���/s��         w   x����0��f
�@�.���c�Gj)�%v��U���'ݻ[�e�}�(����/tS�ةd9���{#�\��+ӫ㤼7T�s�F��m�9jE���i��9@���_�؜�sJ��0d         W   x�3��JMKUHIU((:�0�$39��34�1�����\���8c�89�L9��2�R��9�|��
,uLt�Aj�t��0F��� ZR<      �      x������ � �      �      x�3�H-:��+F��� ��         �   x�3�4�C�K�TH-V�J,K��2�!���%*$�$�*$�e�$� �� �� ktqr��2�E]��/��ʕ$*g�$Vd�+��ڕ%)��&e�+�*䥖+�Bx��6� \1z\\\ ��4�            x�3�4����� v!         h   x�3�4���+)�O)MN�<�9O!1G!���8��(圓X�Z��X��W���X�e�r]򓋹L�T�e���BL-JKLF�i�����ed�$�&�c���� ��'�            x������ � �      �      x������ � �         0  x�}�MK�@�ϓ_19
f�M��)B�8	
O� �dH�$�q7��^�揙P
�d`�|�ϫ����8����<�<\SU�{稴@�˲&]���K)#9���{Ʋ�-�+���x�?�	�������`�����|r�)AK�EJEj�j��ċTA�p�M��ѓ�����������G����wȏ8U�e�L�����w�5�k�X3��C�5���GY{̭yc�q�2��dZ2X�{�B�;�U�%yl�/C\��E2�5�юr�X����>��!�2Qً�I*�b���YA��@2      �      x������ � �     