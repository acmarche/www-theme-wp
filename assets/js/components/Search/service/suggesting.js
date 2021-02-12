/**
 * todo insert searchScreen, doublon
 */
import { suggestElastic } from 'search-service';

const {
    useState,
    useEffect
} = wp.element;

function Suggesting( propos ) {
    const { keyword, setKeyword } = propos;
    const [ searchTimeout, setSearchTimeout ] = useState( null );

    const handleChange = ( event ) => {
        const query = event.target.value;

        if ( searchTimeout ) {
            clearTimeout( searchTimeout );
        }

        setSearchTimeout( setTimeout( () => {
            setKeyword( query );
            setSearchTimeout( null );
        }, 500 ) );
    };

    async function executeSearch() {
        let response;
        try {
            response = await suggestElastic( keyword );
            const { data } = response;
            console.log( data );
            propos.setSuggestionsList( data );
        } catch ( e ) {
            console.log( e );
        }
        return null;
    }

    const isSearching = undefined !== keyword && 2 < keyword.length;

    useEffect( () => {
        if ( isSearching ) {
            console.log( `execute suggest ${keyword}` );
            executeSearch( keyword );
        }
    }, [ keyword ]);
}

export default Suggesting;
