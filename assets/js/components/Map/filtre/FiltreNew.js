import Axios from 'axios';
import FiltreLi from './FiltreLi';
import FiltreSelect from './FiltreSelect';
import { loadFiltres } from '../service/map-service';

const { useState, useEffect } = wp.element;

function FiltreNew({
    setMarkerData,
    setKmlKey
}) {
    const [ filtres, setFiltres ] = useState([]);

    async function loadingFiltres() {
        let response;
        try {
            response = await loadFiltres();
            const { data } = response;
            setFiltres( data );
        } catch ( e ) {
            console.log( e );
        }
        return null;
    }

    useEffect( () => {
        loadingFiltres();
    }, [ ]);

    const handleClick = ( arg ) => {
        console.log( `request ${arg}` );
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
                console.log( err );
            });
    };

    return (
        <>
            {/* <!--tabs --> */}
            <div
                className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10 overflowY-auto mh-700px">
                <FiltreLi
                    filtres={filtres}
                    handleClick={ handleClick}
                    setKmlKey={setKmlKey}
                />
                <FiltreSelect
                    filtres={filtres}
                    handleClick={ handleClick}
                    setKmlKey={setKmlKey}/>
            </div>
        </>
    );
}

export default FiltreNew;
