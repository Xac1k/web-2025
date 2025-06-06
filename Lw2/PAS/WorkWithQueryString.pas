PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  GPC;
VAR
  Request: STRING;

FUNCTION GetValueFromString(Key, Text: STRING): STRING;
VAR
  PosKey, PosEnd, LengthKey: INTEGER;
  PreviousSymbol, Temp: STRING;
BEGIN
  LengthKey := Length(Key + '=');
  PosKey := Pos(Key + '=', Text);
  PosEnd := Pos('&', Text);
  IF (PosEnd = 0) 
  THEN
    PosEnd := Length(Text) + 1;
  {WRITELN(Text);
  WRITELN(PosKey);
  WRITELN(PosEnd);
  WRITELN(LengthKey);}
  PreviousSymbol := Copy(Text, PosKey - 1, 1);
  IF ((PreviousSymbol = '') OR (PreviousSymbol = '&')) AND (PosKey <> 0)
  THEN
    IF (PosKey > PosEnd)
    THEN
      BEGIN
        Temp := Copy(Text, PosEnd + 1, Length(Text) - PosEnd);
        GetValueFromString := GetValueFromString(Key, Temp)
      END
    ELSE 
      GetValueFromString := Copy(Text, PosKey + LengthKey, PosEnd  - (PosKey + LengthKey))
  ELSE
    IF (PosEnd = Length(Text)) OR (PosKey = 0)
    THEN 
      GetValueFromString := ''
    ELSE
      BEGIN
        Temp := Copy(Text, PosEnd + 1, Length(Text) - PosEnd);
        GetValueFromString := GetValueFromString(Key, Temp)
      END
END;

BEGIN {WorkWithQueryString}
  Request := GetEnv('QUERY_STRING');
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetValueFromString('first_name', Request));
  WRITELN('Last Name: ', GetValueFromString('last_name', Request));
  WRITELN('Age: ', GetValueFromString('age', Request))
END. {WorkWithQueryString}

