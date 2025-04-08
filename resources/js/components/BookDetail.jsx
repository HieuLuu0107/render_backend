import { useNotification } from '../contexts/NotificationContext';

const BookDetail = () => {
    const { refreshNotifications } = useNotification();

    const handleBorrow = async () => {
        try {
            const response = await axios.post(`/api/v1/books/${bookId}/borrow`);
            if (response.status === 201) {
                toast.success('Mượn sách thành công');
                fetchBookDetails();
                refreshNotifications();
            }
        } catch (error) {
            console.error('Borrow error:', error.response?.data);
            
            if (error.response?.status === 403) {
                toast.error('Bạn cần nâng cấp lên gói Premium để mượn sách');
            } else if (error.response?.status === 400) {
                toast.error(error.response.data?.message || 'Không thể mượn sách này');
            } else {
                toast.error('Có lỗi xảy ra khi mượn sách');
            }
        }
    };

    const handleReserve = async () => {
        try {
            const response = await axios.post(`/api/v1/books/${bookId}/reserve`);
            if (response.status === 201) {
                toast.success('Đặt trước sách thành công');
                fetchBookDetails();
                refreshNotifications();
            }
        } catch (error) {
            console.error('Reserve error:', error.response?.data);
            
            if (error.response?.status === 403) {
                toast.error('Bạn cần nâng cấp lên gói Premium để đặt trước sách');
            } else if (error.response?.status === 400) {
                toast.error(error.response.data?.message || 'Không thể đặt trước sách này');
            } else {
                toast.error('Có lỗi xảy ra khi đặt trước sách');
            }
        }
    };
}; 