import { useNotification } from '../../contexts/NotificationContext';

const Register = () => {
    const { refreshNotifications } = useNotification();

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('/api/v1/auth/register', formData);
            if (response.status === 201) {
                toast.success('Đăng ký thành công');
                refreshNotifications(); // Thay thế window.location.reload()
            }
        } catch (error) {
            // Xử lý lỗi...
        }
    };
}; 