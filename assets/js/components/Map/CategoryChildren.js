import Axios from 'axios';

function CategoryChildren({
    name
}) {
    console.log( name );
    const scrollToMapIfMobile = () => {
        console.log( window.innerWidth );
        if ( 1000 > window.innerWidth ) {
            const mapPosition = document
                .querySelector( '.leaflet-container' )
                .getBoundingClientRect().bottom;
            console.log( mapPosition );
            window.scroll({
                top: mapPosition,
                left: 0,
                behavior: 'smooth'
            });
        }
    };
    const handleClick = ( event ) => {
        scrollToMapIfMobile();
        Axios.get( `https://new.marche.be/wp-json/ca/v1/map/${event.target.id}` )
            .then( ( res ) => {
                if ( 0 !== res.data.length ) {

                    //   setMarkerData( res.data );
                } else {

                    //  return setMarkerData( null );
                }
            })
            .catch( ( err ) => console.log( err.message ) );
    };

    return (
        <li className="border-top" key="1">
            <p
                style={{ cursor: 'pointer' }}
                onClick={( e ) => handleClick( e )}
                className="d-flex align-items-center p-16px text-dark-primary text-hover-primary transition-color icon_custom"
            >
                { name }
            </p>
        </li>
    );
}

export default CategoryChildren;
