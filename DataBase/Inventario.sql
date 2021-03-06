/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     12/6/2017 19:29:49                           */
/*==============================================================*/


drop table if exists INV_TAB_AJUSTES_PRODUCTOS;

drop table if exists INV_TAB_DETALLE_AJUSTE_PROD;

drop table if exists INV_TAB_PRODUCTOS;

drop table if exists INV_TAB_TIPO_USUARIO;

drop table if exists INV_TAB_USUARIOS;

/*==============================================================*/
/* Table: INV_TAB_AJUSTES_PRODUCTOS                             */
/*==============================================================*/
create table INV_TAB_AJUSTES_PRODUCTOS
(
   ID_AJUSTE_PROD       varchar(9) not null,
   MOTIVO_AJUSTE_PROD   varchar(150) not null,
   FECHA_AJUSTE_PROD    datetime not null,
   primary key (ID_AJUSTE_PROD)
);

/*==============================================================*/
/* Table: INV_TAB_DETALLE_AJUSTE_PROD                           */
/*==============================================================*/
create table INV_TAB_DETALLE_AJUSTE_PROD
(
   ID_DETALLE_AJUSTE_PROD char(9) not null,
   ID_PROD              varchar(9),
   ID_AJUSTE_PROD       varchar(9),
   ID_USU               varchar(9),
   CAMBIO_DEL_STOCK_DEL_PRODUCTO int not null,
   primary key (ID_DETALLE_AJUSTE_PROD)
);

/*==============================================================*/
/* Table: INV_TAB_PRODUCTOS                                     */
/*==============================================================*/
create table INV_TAB_PRODUCTOS
(
   ID_PROD              varchar(9) not null,
   NOMBRE_PROD          varchar(20) not null,
   DESCRIPCION_PROD     varchar(150) not null,
   GRABA_IVA_PROD       varchar(1) not null,
   COSTO_PROD           float(8,2) not null,
   PVP_PROD             float(8,2) not null,
   ESTADO_PROD          varchar(1) not null,
   STOCK_PROD           int not null,
   primary key (ID_PROD)
);

/*==============================================================*/
/* Table: INV_TAB_TIPO_USUARIO                                  */
/*==============================================================*/
create table INV_TAB_TIPO_USUARIO
(
   ID_TIPO_USU          varchar(9) not null,
   NOMBRE_TIPO_USU      varchar(30) not null,
   primary key (ID_TIPO_USU)
);

/*==============================================================*/
/* Table: INV_TAB_USUARIOS                                      */
/*==============================================================*/
create table INV_TAB_USUARIOS
(
   ID_USU               varchar(9) not null,
   ID_TIPO_USU          varchar(20),
   CEDULA_RUC_PASS_USU  varchar(20) not null,
   NOMBRES_USU          varchar(50) not null,
   APELLIDOS_USU        varchar(50) not null,
   FECH_NAC_USU         date not null,
   CIUDAD_NAC_USU       varchar(30) not null,
   DIRECCION_USU        varchar(100) not null,
   FONO_USU             varchar(11),
   E_MAIL_USU           varchar(100),
   ESTADO_USU           char(1) not null default 'A',
   primary key (ID_USU)
);

alter table INV_TAB_DETALLE_AJUSTE_PROD add constraint FK_REFERENCE_2 foreign key (ID_PROD)
      references INV_TAB_PRODUCTOS (ID_PROD) on delete restrict on update restrict;

alter table INV_TAB_DETALLE_AJUSTE_PROD add constraint FK_REFERENCE_3 foreign key (ID_AJUSTE_PROD)
      references INV_TAB_AJUSTES_PRODUCTOS (ID_AJUSTE_PROD) on delete restrict on update restrict;

alter table INV_TAB_DETALLE_AJUSTE_PROD add constraint FK_REFERENCE_4 foreign key (ID_USU)
      references INV_TAB_USUARIOS (ID_USU) on delete restrict on update restrict;

alter table INV_TAB_USUARIOS add constraint FK_REFERENCE_1 foreign key (ID_TIPO_USU)
      references INV_TAB_TIPO_USUARIO (ID_TIPO_USU) on delete restrict on update restrict;

