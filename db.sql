create table propel_migration
(
    version int default 0 null
);

create table tests
(
    id        int unsigned auto_increment
        primary key,
    test_name varchar(127) null,
    created   datetime     not null,
    updated   datetime     not null
)
    collate = utf8mb4_unicode_ci;

create index created
    on tests (created);

create index test_name
    on tests (test_name);

create index updated
    on tests (updated);

create table variants
(
    id           int unsigned auto_increment
        primary key,
    test_id      int unsigned not null,
    variant_name varchar(127) not null,
    metadata     varchar(127) null,
    created      datetime     not null,
    updated      datetime     not null,
    constraint variants_fk_dbfee7
        foreign key (test_id) references tests (id)
)
    collate = utf8mb4_unicode_ci;

create index created
    on variants (created);

create index test_id
    on variants (test_id);

create index updated
    on variants (updated);

create index variant_name
    on variants (variant_name);

create table visitors
(
    id      int unsigned auto_increment
        primary key,
    created datetime not null,
    updated datetime not null
)
    collate = utf8mb4_unicode_ci;

create table assigned_variants
(
    id                  int unsigned auto_increment
        primary key,
    internal_visitor_id int unsigned not null,
    variant_id          int unsigned not null,
    created             datetime     not null,
    updated             datetime     not null,
    constraint assigned_variants_fk_595f0d
        foreign key (internal_visitor_id) references visitors (id),
    constraint assigned_variants_fk_f19ff8
        foreign key (variant_id) references variants (id)
)
    collate = utf8mb4_unicode_ci;

create index created
    on assigned_variants (created);

create index internal_visitor_id
    on assigned_variants (internal_visitor_id);

create index updated
    on assigned_variants (updated);

create index variant_id
    on assigned_variants (variant_id);

create table external_visitors
(
    id                  int unsigned auto_increment
        primary key,
    internal_visitor_id int unsigned not null,
    external_visitor_id varchar(127) not null,
    external_id_type    varchar(127) not null,
    expires             int unsigned not null,
    created             datetime     not null,
    updated             datetime     not null,
    constraint external_visitors_fk_595f0d
        foreign key (internal_visitor_id) references visitors (id)
)
    collate = utf8mb4_unicode_ci;

create index created
    on external_visitors (created);

create index expires
    on external_visitors (expires);

create index external_id_type
    on external_visitors (external_id_type);

create index external_visitor_id
    on external_visitors (external_visitor_id);

create index internal_visitor_id
    on external_visitors (internal_visitor_id);

create index updated
    on external_visitors (updated);

create index created
    on visitors (created);

create index updated
    on visitors (updated);

INSERT INTO probatio.propel_migration (version) VALUES (1601596405);
INSERT INTO probatio.propel_migration (version) VALUES (1601596967);
INSERT INTO probatio.propel_migration (version) VALUES (1601602825);
INSERT INTO probatio.propel_migration (version) VALUES (1601602917);
INSERT INTO probatio.propel_migration (version) VALUES (1601641971);
INSERT INTO probatio.propel_migration (version) VALUES (1601643129);