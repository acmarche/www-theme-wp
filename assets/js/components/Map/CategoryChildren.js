import Axios from 'axios';

function CategoryChildren({
    name,
    filtreKey,
    setMarkerData,
    setKmlKey
}) {
  //  console.log( name, filtreKey );
    const scrollToMapIfMobile = () => {
       // console.log( window.innerWidth );
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
        console.log( arg );
        scrollToMapIfMobile();
        Axios.get( `https://new.marche.be/wp-json/map/data/${arg}` )
            .then( ( res ) => {
                if ( 0 !== res.data.length ) {
                    console.log( res );
                    if ( true === res.data.kml ) {
                        setKmlKey( res.data.data );
                        setMarkerData( null );
                        console.log( 'kml' );
                    } else {
                        setMarkerData( res.data.data );
                        setKmlKey( null );
                    }
                } else {
                    setKmlKey( null );
                    setMarkerData( null );
                    return null;
                }
            })
            .catch( ( err ) => console.log( err.message ) );
    };

    return (
        <li className="border-top" key={filtreKey}>
            <p
                style={{ cursor: 'pointer' }}
                onClick={( e ) => handleClick( filtreKey )}
                className="d-flex align-items-center p-16px text-dark-primary text-hover-primary transition-color icon_custom"
            >
                { name }
            </p>
        </li>
    );
}

export default CategoryChildren;
