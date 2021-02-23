import Axios from 'axios';

function CategoryChildren({
    name,
    filtreKey
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

                    //   setMarkerData( res.data );
                } else {

                    //  return setMarkerData( null );
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
