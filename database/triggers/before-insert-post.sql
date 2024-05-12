CREATE TRIGGER before_insert_post
BEFORE INSERT ON public.post
FOR EACH ROW
EXECUTE FUNCTION set_dates_and_status();