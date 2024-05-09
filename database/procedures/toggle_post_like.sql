CREATE OR REPLACE PROCEDURE toggle_post_like(
    p_user_id UUID,
    p_post_id INTEGER
)
LANGUAGE plpgsql
AS $$
DECLARE
    post_liked BOOLEAN;
BEGIN
    SELECT EXISTS (
        SELECT 1
        FROM public.likes
        WHERE user_id = p_user_id
        AND post_id = p_post_id
    ) INTO post_liked;

    IF post_liked THEN
        DELETE FROM public.likes
        WHERE user_id = p_user_id
        AND post_id = p_post_id;
        
        UPDATE public.post
        SET likes_count = likes_count - 1
        WHERE id = p_post_id;
    ELSE
        INSERT INTO public.likes (user_id, post_id)
        VALUES (p_user_id, p_post_id);
        
        UPDATE public.post
        SET likes_count = likes_count + 1
        WHERE id = p_post_id;
    END IF;
END;
$$;