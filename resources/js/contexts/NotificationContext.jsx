import React, { createContext, useContext, useState } from 'react';

const NotificationContext = createContext();

export const NotificationProvider = ({ children }) => {
    const [refreshKey, setRefreshKey] = useState(0);

    const refreshNotifications = () => {
        setRefreshKey(prev => prev + 1);
    };

    return (
        <NotificationContext.Provider value={{ refreshKey, refreshNotifications }}>
            {children}
        </NotificationContext.Provider>
    );
};

export const useNotification = () => useContext(NotificationContext); 