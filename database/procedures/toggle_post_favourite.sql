CREATE OR REPLACE PROCEDURE toggle_post_favourite(
    p_user_id UUID,
    p_post_id INTEGER
)
LANGUAGE plpgsql
AS $$
DECLARE
    post_favourited BOOLEAN;
BEGIN
    SELECT EXISTS (
        SELECT 1
        FROM public.favourites
        WHERE user_id = p_user_id
        AND post_id = p_post_id
    ) INTO post_favourited;

    IF post_favourited THEN
        DELETE FROM public.favourites
        WHERE user_id = p_user_id
        AND post_id = p_post_id;
    ELSE
        INSERT INTO public.favourites (user_id, post_id)
        VALUES (p_user_id, p_post_id);
    END IF;
END;
$$;
