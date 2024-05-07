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
        FROM public.user_post
        WHERE user_id = p_user_id
        AND post_id = p_post_id
        AND action_type = 'like'
    ) INTO post_liked;

    IF post_liked THEN
        DELETE FROM public.user_post
        WHERE user_id = p_user_id
        AND post_id = p_post_id
        AND action_type = 'like';
        
        UPDATE public.post
        SET likes_count = likes_count - 1
        WHERE id = p_post_id;
    ELSE
        INSERT INTO public.user_post (user_id, post_id, action_type)
        VALUES (p_user_id, p_post_id, 'like');
        
        UPDATE public.post
        SET likes_count = likes_count + 1
        WHERE id = p_post_id;
    END IF;
END;
$$;