PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  GPC;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  PosKey, PosMark: INTEGER;
  QueryString: STRING;
BEGIN
  QueryString := GetEnv('QUERY_STRING');
  PosKey := Pos(Key, QueryString);
  QueryString := Copy(QueryString, PosKey, Length(QueryString) - PosKey + 1);
  PosMark := Pos('&', QueryString);

  IF PosMark <> 0
  THEN
    QueryString := Copy(QueryString, Length(Key) + 2, PosMark - Length(Key) - 2)
  ELSE
    QueryString := Copy(QueryString, Length(Key) + 2, Length(QueryString) - Length(Key) - 1);
  
  GetQueryStringParameter := QueryString 
END;

BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END. {WorkWithQueryString}

