import { useNotification } from '../contexts/NotificationContext';

const Navbar = () => {
    const { refreshKey } = useNotification();
    
    // Khi refreshKey thay đổi, NotificationBell sẽ được render lại
    return (
        <AppBar position="static">
            {/* ... other navbar items ... */}
            <NotificationBell key={refreshKey} />
            {/* ... */}
        </AppBar>
    );
}; 