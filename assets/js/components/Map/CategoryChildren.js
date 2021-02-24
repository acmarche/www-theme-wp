import Axios from 'axios';

function CategoryChildren({
    name,
    filtreKey,
    setMarkerData,
    setKmlKey
}) {
    const scrollToMapIfMobile = () => {
        if ( 1000 > window.innerWidth ) {
            const mapPosition = document
                .querySelector( '.leaflet-container' )
                .getBoundingClientRect().bottom;

            //    console.log( mapPosition );
            window.scroll({
                top: mapPosition,
                left: 0,
                behavior: 'smooth'
            });
        }
    };

    const handleClick = ( arg ) => {
        console.log( `request ${arg}` );
        scrollToMapIfMobile();
        Axios.get( `https://new.marche.be/wp-json/map/data/${arg}` )
            .then( ( res ) => {
                if ( 0 !== res.data.length ) {
                    console.log( res );
                    if ( true === res.data.kml ) {
                        setKmlKey( res.data.data );
                        setMarkerData( null );
                    } else {
                        if ( 0 === res.data.data.length ) {
                            alert( 'Aucune données trouvées' );
                        }
                        setMarkerData( res.data.data );
                        setKmlKey( null );
                    }
                } else {
                    alert( 'Aucune données trouvées' );
                    setKmlKey( null );
                    setMarkerData( null );
                    return null;
                }
            })
            .catch( ( err ) => {
                //todo remote error for user
                console.log( err.message );
            });
    };

    return (
        <li className="border-top" key={filtreKey}>
            <p
                style={{ cursor: 'pointer' }}
                onClick={() => handleClick( filtreKey )}
                className="d-flex align-items-center p-16px text-dark-primary text-hover-primary transition-color icon_custom"
            >
                {name}
            </p>
        </li>
    );
}

export default CategoryChildren;
