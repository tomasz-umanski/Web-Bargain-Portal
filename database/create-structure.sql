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
    user_id uuid NOT NULL,
    category_id integer NOT NULL,
    status text NOT NULL DEFAULT 'active',
    last_updated timestamp with time zone NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.users
(
    id uuid NOT NULL DEFAULT gen_random_uuid(),
    user_name text NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    role_id integer NOT NULL,
    is_active boolean NOT NULL DEFAULT true,
    PRIMARY KEY (id),
    UNIQUE (user_name),
    UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS public.category
(
    id serial NOT NULL,
    name text NOT NULL,
    url text NOT NULL,
    icon text NOT NULL,
    is_active boolean NOT NULL DEFAULT true,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.likes
(
    id serial NOT NULL,
    user_id uuid NOT NULL,
    post_id integer NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.favourites
(
    id serial NOT NULL,
    user_id uuid NOT NULL,
    post_id integer NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.user_roles
(
    id serial NOT NULL,
    name text NOT NULL,
    description text NOT NULL,
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


ALTER TABLE IF EXISTS public.users
    ADD FOREIGN KEY (role_id)
    REFERENCES public.user_roles (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;


ALTER TABLE IF EXISTS public.likes
    ADD FOREIGN KEY (user_id)
    REFERENCES public.users (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;


ALTER TABLE IF EXISTS public.likes
    ADD FOREIGN KEY (post_id)
    REFERENCES public.post (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;


ALTER TABLE IF EXISTS public.favourites
    ADD FOREIGN KEY (user_id)
    REFERENCES public.users (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;


ALTER TABLE IF EXISTS public.favourites
    ADD FOREIGN KEY (post_id)
    REFERENCES public.post (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

END;