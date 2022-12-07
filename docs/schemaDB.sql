create or replace database tiendaonline;
use tiendaonline;
create or replace table categories
(
    id bigint unsigned auto_increment
        primary key,
    name varchar(250) not null,
    description text null,
    thumbnail varchar(255) null,
    created_at timestamp null,
    updated_at timestamp null
)
    collate=utf8mb4_unicode_ci;


create or replace table orders
(
    id bigint unsigned auto_increment
        primary key,
    ammount double(6,2) not null,
    shipping_address varchar(450) not null,
    order_email varchar(256) not null,
    order_date datetime not null,
    order_status enum('BILLING_PENDING', 'PENDING', 'COMPLETED', 'CANCELED', 'FAILED', 'REFUND') default 'PENDING' not null,
    full_name varchar(150) null,
    billing_address varchar(450) not null,
    country varchar(100) null,
    phone varchar(30) null,
    created_at timestamp null,
    updated_at timestamp null
)
    collate=utf8mb4_unicode_ci;



create or replace table products
(
    id bigint unsigned auto_increment
        primary key,
    sku varchar(255) not null,
    name varchar(250) not null,
    price double(6,2) not null,
    description text null,
    thumbnail varchar(255) null,
    image varchar(255) null,
    stock int unsigned default 0 not null,
    created_at timestamp null,
    updated_at timestamp null,
    constraint products_sku_unique
        unique (sku)
)
    collate=utf8mb4_unicode_ci;

create or replace table category_product
(
    id int unsigned auto_increment
        primary key,
    category_id bigint unsigned not null,
    product_id bigint unsigned not null,
    constraint category_product_category_id_product_id_unique
        unique (category_id, product_id),
    constraint category_product_category_id_foreign
        foreign key (category_id) references categories (id)
            on update cascade on delete cascade,
    constraint category_product_product_id_foreign
        foreign key (product_id) references products (id)
            on update cascade on delete cascade
)
    collate=utf8mb4_unicode_ci;

create or replace table orders_lines
(
    id bigint unsigned auto_increment
        primary key,
    sku char(36) not null,
    quantity int not null,
    price double(6,2) not null,
    created_at timestamp null,
    updated_at timestamp null,
    id_order bigint unsigned not null,
    id_product bigint unsigned null,
    constraint orders_lines_id_order_id_product_unique
        unique (id_order, id_product),
    constraint orders_lines_sku_id_order_unique
        unique (sku, id_order),
    constraint orders_lines_id_order_foreign
        foreign key (id_order) references orders (id)
            on update cascade on delete cascade,
    constraint orders_lines_id_product_foreign
        foreign key (id_product) references products (id)
            on update cascade on delete set null
)
    collate=utf8mb4_unicode_ci;

create table users
(
    id                int unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;

INSERT INTO categories (id, name, description, thumbnail, created_at, updated_at) VALUES (1, 'Zapatos', 'Todo tipo de Zapatos', null, '2022-12-07 13:01:22', '2022-12-07 13:01:22');
INSERT INTO categories (id, name, description, thumbnail, created_at, updated_at) VALUES (2, 'Chaquetas', 'Todo tipo de Chaquetas', null, '2022-12-07 13:01:22', '2022-12-07 13:01:22');
INSERT INTO categories (id, name, description, thumbnail, created_at, updated_at) VALUES (3, 'Ofertas de Navidad', 'Todo tipo de Ofertas de Navidad', null, '2022-12-07 13:01:22', '2022-12-07 13:01:22');

INSERT INTO products (id, sku, name, price, description, thumbnail, image, stock, created_at, updated_at) VALUES (1, 'Shoes-Black-US44', 'Zapato de Tacon Negro', 35.6, 'Tacones de exclusivos de Zara color negro para Mujer', null, 'storage/products/tacon-negro.jpg', 60, '2022-12-07 13:01:22', '2022-12-07 13:01:22');
INSERT INTO products (id, sku, name, price, description, thumbnail, image, stock, created_at, updated_at) VALUES (2, 'Shoes-Black-Men-US45', 'Zapato de vestir hombre', 50.6, 'Zapato de vestir para hombre de color negro', null, 'storage/products/zapato-hombre.png', 30, '2022-12-07 13:01:22', '2022-12-07 13:01:22');
INSERT INTO products (id, sku, name, price, description, thumbnail, image, stock, created_at, updated_at) VALUES (3, 'Anorak-Beige-XXL', 'Anorak de Deporte', 20.6, 'Anorak Deportivo de color discreto', null, 'storage/products/anorak-casual-jacket.jpg', 25, '2022-12-07 13:01:22', '2022-12-07 13:01:22');

INSERT INTO category_product (id, category_id, product_id) VALUES (1, 1, 1);
INSERT INTO category_product (id, category_id, product_id) VALUES (3, 1, 2);
INSERT INTO category_product (id, category_id, product_id) VALUES (4, 2, 3);
INSERT INTO category_product (id, category_id, product_id) VALUES (2, 3, 1);
INSERT INTO category_product (id, category_id, product_id) VALUES (5, 3, 3);

-- password = 'password'
INSERT INTO users (id, name, email, email_verified_at, password, created_at, updated_at) VALUES (1, 'admin', 'admin@admin.com', '2022-12-07 13:01:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2022-12-07 13:01:22', '2022-12-07 13:01:22');
