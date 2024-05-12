CREATE TRIGGER before_update_post
BEFORE UPDATE ON public.post
FOR EACH ROW
EXECUTE FUNCTION set_dates_and_status();