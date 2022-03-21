import Axios from 'axios';
import FiltreLi from './FiltreLi';
import FiltreSelect from './FiltreSelect';
import { loadFiltres } from '../service/map-service';

const {
    useState,
    useEffect
} = wp.element;

function Filtres( {
    setMarkerData,
    setKmlKey,
    setOptionSelected
} ) {
    const [ filtres, setFiltres ] = useState( [] );

    async function loadingFiltres() {
        let response;
        try {
            response = await loadFiltres();
            const { data } = response;
            setFiltres( data );
        } catch (e) {
            console.log( e );
        }
        return null;
    }

    useEffect( () => {
        loadingFiltres();
        const hash = window.location.hash.substr( 1 );//#x in url
        if (hash) {
            handleClick( hash, hash );
        }
    }, [] );

    const handleClick = ( arg, name ) => {
        console.log( `request ${arg}` );
        setOptionSelected( name );

        Axios.get( `https://www.marche.be/wp-json/map/data/${arg}` )
            .then( ( res ) => {
                if (0 !== res.data.length) {
                    if (true === res.data.kml) {
                        setMarkerData( res.data.data );
                    } else {
                        if (0 === res.data.data.length) {
                            alert( 'Aucune données trouvées' );
                        }
                        setMarkerData( res.data.data );
                    }
                } else {
                    alert( 'Aucune données trouvées' );
                    setKmlKey( null );
                    setMarkerData( [] );
                    return null;
                }
            } )
            .catch( ( err ) => {
                console.log( err );
            } );
    };

    return (
        <>
            {/* <!--tabs --> */}
            <div
                className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10 overflowY-auto mh-700px">
                <FiltreLi
                    filtres={filtres}
                    handleClick={handleClick}
                    setKmlKey={setKmlKey}
                />
                <FiltreSelect
                    filtres={filtres}
                    handleClick={handleClick}
                    setKmlKey={setKmlKey}/>
            </div>
        </>
    );
}

export default Filtres;
