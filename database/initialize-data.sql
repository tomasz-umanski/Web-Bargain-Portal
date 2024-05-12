INSERT INTO public.user_roles (id, name, description)
VALUES 
    (1, 'admin', 'Has full access and control over the system.'),
    (2, 'client', 'Limited access, primarily for accessing services and functionalities.');


INSERT INTO public.category(id, name, url, icon, is_active)
VALUES 
    (1, 'Technology', 'technology', 'bi bi-laptop', true),
    (2, 'Sports', 'sports', 'bi bi-trophy', true),
    (3, 'Fashion', 'fashion', 'bi bi-bag', true),
    (4, 'Food', 'food', 'bi bi-cup', true),
    (5, 'Travel', 'travel', 'bi bi-plane', true);
