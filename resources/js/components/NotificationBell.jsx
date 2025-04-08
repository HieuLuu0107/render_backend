import React, { useEffect, useState, useCallback } from 'react';
import Echo from 'laravel-echo';
import axios from 'axios';
import { Badge, IconButton, Menu, MenuItem } from '@mui/material';
import NotificationsIcon from '@mui/icons-material/Notifications';
import { format } from 'date-fns';
import { vi } from 'date-fns/locale';
import { toast } from 'react-hot-toast';

const NotificationBell = () => {
    const [unreadCount, setUnreadCount] = useState(0);
    const [notifications, setNotifications] = useState([]);
    const [anchorEl, setAnchorEl] = useState(null);
    const open = Boolean(anchorEl);

    const fetchNotifications = useCallback(async () => {
        try {
            const response = await axios.get('/api/v1/notifications');
            setNotifications(response.data.data);
            setUnreadCount(response.data.unread_count);
        } catch (error) {
            console.error('Error fetching notifications:', error);
        }
    }, []);

    const handleMarkAsRead = async (notificationId) => {
        try {
            await axios.post(`/api/v1/notifications/${notificationId}/read`);
            fetchNotifications(); // Refresh notifications after marking as read
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    };

    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    useEffect(() => {
        fetchNotifications();

        // Lắng nghe sự kiện cập nhật thông báo từ các component khác
        window.addEventListener('notification-update', fetchNotifications);

        // Khởi tạo Pusher
        const echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.REACT_APP_PUSHER_KEY,
            cluster: process.env.REACT_APP_PUSHER_CLUSTER,
            encrypted: true
        });

        // Lắng nghe kênh private của user
        const channel = echo.private(`notifications.${window.Laravel.user.id}`);
        
        channel.listen('.NewNotification', (e) => {
            console.log('New notification received:', e);
            // Cập nhật số lượng thông báo
            setUnreadCount(prev => prev + 1);
            // Cập nhật danh sách thông báo
            fetchNotifications();
            // Hiển thị toast thông báo
            toast.success(e.title);
        });

        return () => {
            window.removeEventListener('notification-update', fetchNotifications);
            channel.stopListening('.NewNotification');
        };
    }, [fetchNotifications]);

    return (
        <>
            <IconButton
                color="inherit"
                onClick={handleClick}
                aria-controls={open ? 'notifications-menu' : undefined}
                aria-haspopup="true"
                aria-expanded={open ? 'true' : undefined}
            >
                <Badge badgeContent={unreadCount} color="error">
                    <NotificationsIcon />
                </Badge>
            </IconButton>

            <Menu
                id="notifications-menu"
                anchorEl={anchorEl}
                open={open}
                onClose={handleClose}
                MenuListProps={{
                    'aria-labelledby': 'notifications-button',
                }}
                PaperProps={{
                    style: {
                        maxHeight: 400,
                        width: '350px',
                    },
                }}
            >
                {notifications.length > 0 ? (
                    notifications.map((notification) => (
                        <MenuItem 
                            key={notification.id}
                            onClick={() => {
                                handleMarkAsRead(notification.id);
                                handleClose();
                            }}
                            style={{
                                backgroundColor: notification.read_at ? 'transparent' : '#f5f5f5',
                                whiteSpace: 'normal',
                                padding: '10px 15px',
                            }}
                        >
                            <div style={{ width: '100%' }}>
                                <div style={{ fontWeight: 'bold' }}>{notification.title}</div>
                                <div>{notification.content}</div>
                                <div style={{ fontSize: '0.8em', color: '#666', marginTop: '5px' }}>
                                    {format(new Date(notification.created_at), 'dd/MM/yyyy HH:mm', { locale: vi })}
                                </div>
                            </div>
                        </MenuItem>
                    ))
                ) : (
                    <MenuItem disabled>Không có thông báo mới</MenuItem>
                )}
            </Menu>
        </>
    );
};

export default NotificationBell; 