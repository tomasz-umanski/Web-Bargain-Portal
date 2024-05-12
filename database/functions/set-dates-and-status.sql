CREATE OR REPLACE FUNCTION set_dates_and_status()
RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.creation_date := NOW();
        NEW.last_updated := NOW();
        NEW.status := 'pending';
    ELSIF TG_OP = 'UPDATE' THEN
        NEW.last_updated := NOW();
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;