BEGIN;


CREATE TABLE IF NOT EXISTS public.post
(
    id serial NOT NULL,
    title text NOT NULL,
    description text NOT NULL,
    new_price numeric NOT NULL,
    old_price numeric NOT NULL,
    delivery_price numeric NOT NULL,
    likes_count integer NOT NULL DEFAULT 0,
    offer_url text NOT NULL,
    image_url text NOT NULL,
    creation_date timestamp with time zone NOT NULL,
    end_date timestamp with time zone NOT NULL,
    user_id integer NOT NULL,
    category_id integer NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.users
(
    id serial NOT NULL,
    user_name text NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.category
(
    id serial NOT NULL,
    name text NOT NULL,
    url text NOT NULL,
    icon text NOT NULL,
    PRIMARY KEY (id)
);

ALTER TABLE IF EXISTS public.post
    ADD FOREIGN KEY (user_id)
    REFERENCES public.users (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;


ALTER TABLE IF EXISTS public.post
    ADD FOREIGN KEY (category_id)
    REFERENCES public.category (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

END;