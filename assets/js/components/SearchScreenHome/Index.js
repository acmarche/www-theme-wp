import HardCodedValues from './HardCodedValues';
import KeywordsValue from './KeywordsValue';
import axios from '../Axios';

const {
    useState,
    useEffect
} = wp.element;

function App() {
    const [ inputContent, setInputContent ] = useState();
    const [ keywordsElement, SetKeywordsElement ] = useState([]);

    // Cette fonction change la valeur de la variable inputContent
    // a chaque fois que l'utilisateur entre une lettre ou en supprime
    const handleChange = ( e ) => {
        setInputContent( e.target.value );
    };

    // C'est ici que je charge ma liste de proposition grace a axios
    useEffect( () => {
        axios
            .get( 'https://new.marche.be/wp-json/ca/v1/bottinAllCategories' )
            .then( ( res ) => {
                SetKeywordsElement( res.data );
            })
            .catch( ( err ) => console.log( err.message ) );
    }, []);
    return (
        <>
            <h1 className="pb-22px">Bienvenue <br className="d-ls-md-none d-md-none"/>à
            Marche-en-Famenne</h1>
            <form id="search-screen-ho" action="/" method="get" className="mw-550px position-relative m-auto searchHome">
                <input name="s" autoComplete="off" type="search" placeholder="Que cherchez-vous ?"
                    className="border-0 rounded-pill h-42px pl-16px pr-58px fs-short-3"/>
                <button
                    className="position-absolute top-0 bottom-0 right-0 w-42px d-flex justify-content-center align-items-center p-0 border-0 rounded-right-pill bg-transparent icon_custom">
                    <i className="i-search i-dark-primary"></i>
                </button>
                <HardCodedValues></HardCodedValues>
            </form>
        </>
    );
}

export default App;
