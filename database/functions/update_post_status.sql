CREATE OR REPLACE FUNCTION update_post_status(p_post_id INT, p_last_updated timestamp with time zone, p_status text)
RETURNS BOOLEAN AS $$
DECLARE 
    exists_flag BOOLEAN;
BEGIN
    SELECT EXISTS (
        SELECT 1 FROM post
        WHERE id = p_post_id AND last_updated <= p_last_updated
    ) INTO exists_flag;

    IF exists_flag THEN
        UPDATE post
        SET status = p_status
        WHERE id = p_post_id;
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END;
$$ LANGUAGE plpgsql;
