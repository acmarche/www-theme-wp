const {
    useState,
    useEffect
} = wp.element;

//THIS HOOK ASKS FOR THE GEOLOCATION OF THE END USER THROUGH THE BROWSER SETTINGS

// IF TRUE RETURNS A LOCATION

const useGeolocation = () => {
    const [ location, setLocation ] = useState({
        loaded: false,
        coordinates: { lat: '', lng: '' }
    });

    const onSuccess = ( location ) => {
        setLocation({
            loaded: true,
            coordinates: {
                lat: location.coords.latitude,
                lng: location.coords.longitude
            }
        });
    };

    const onError = ( location ) => {
        setLocation({
            loaded: true,
            error
        });
    };

    useEffect( () => {
        if ( ! ( 'geolocation' in navigator ) ) {
            onError({
                code: 0,
                message: 'Geolocalisation non disponible'
            });
        }

        navigator.geolocation.getCurrentPosition( onSuccess, onError );
    }, []);
    return location;
};

export default useGeolocation;
