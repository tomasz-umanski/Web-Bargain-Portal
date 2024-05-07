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
        FROM public.user_post
        WHERE user_id = p_user_id
        AND post_id = p_post_id
        AND action_type = 'favourite'
    ) INTO post_favourited;

    IF post_favourited THEN
        DELETE FROM public.user_post
        WHERE user_id = p_user_id
        AND post_id = p_post_id
        AND action_type = 'favourite';
    ELSE
        INSERT INTO public.user_post (user_id, post_id, action_type)
        VALUES (p_user_id, p_post_id, 'favourite');
    END IF;
END;
$$;
